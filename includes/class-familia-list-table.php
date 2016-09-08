<?php

if ( ! class_exists ( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */
class FamiliaUpDown_List_Table extends \WP_List_Table {

    function __construct() {
        parent::__construct( array(
            'singular' => 'familia',
            'plural'   => 'familias',
            'ajax'     => false
        ) );
    }

    function get_table_classes() {
        return array( 'widefat', 'fixed', 'striped', $this->_args['plural'] );
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'Nenhuma família encontrada!', 'designfaustini' );
    }

    /**
     * Default column values if no callback found
     *
     * @param  object  $item
     * @param  string  $column_name
     *
     * @return string
     */
    function column_default( $item, $column_name ) {

        switch ( $column_name ) {
            case 'nome_pai':
                return $item->nome_pai;

            case 'nome_mae':
                return $item->nome_mae;

            case 'nome_updown':
                return $item->nome_updown;

            case 'qtd_irmao':
                return $item->qtd_irmao;

            case 'end':
                return $item->end;

            case 'cep':
                return $item->cep;

            case 'cidade':
                return $item->cidade;

            case 'uf':
                return $item->uf;

            case 'pais':
                return $item->pais;

            case 'telefone':
                return $item->telefone;

            case 'email':
                return $item->email;

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    /**
     * Get the column names
     *
     * @return array
     */
    function get_columns() {
        $columns = array(
            'cb'           => '<input type="checkbox" />',
            'nome_pai'      => __( 'Pai Up Down', 'designfaustini' ),
            'nome_mae'      => __( 'Mãe Up Down', 'designfaustini' ),
            'nome_updown'      => __( 'Filho(a) Up Down', 'designfaustini' ),
            'qtd_irmao'      => __( 'Qtd. de irmão(s)', 'designfaustini' ),
            'end'      => __( 'Endereço', 'designfaustini' ),
            'cep'      => __( 'CEP', 'designfaustini' ),
            'cidade'      => __( 'Cidade', 'designfaustini' ),
            'uf'      => __( 'Estado', 'designfaustini' ),
            'pais'      => __( 'País', 'designfaustini' ),
            'telefone'      => __( 'Telefone', 'designfaustini' ),
            'email'      => __( 'E-mail', 'designfaustini' ),

        );

        return $columns;
    }

    /**
     * Render the designation name column
     *
     * @param  object  $item
     *
     * @return string
     */
    function column_nome_pai( $item ) {

        $actions           = array();
        $actions['edit']   = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=familiaupdown&action=edit&id=' . $item->id ), $item->id, __( 'Edit this item', 'designfaustini' ), __( 'Edit', 'designfaustini' ) );
        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=familiaupdown&action=delete&id=' . $item->id ), $item->id, __( 'Delete this item', 'designfaustini' ), __( 'Delete', 'designfaustini' ) );

        return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=familiaupdown&action=view&id=' . $item->id ), $item->nome_pai, $this->row_actions( $actions ) );
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = array(
            'name' => array( 'name', true ),
        );

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'designfaustini' ),
        );
        return $actions;
    }

    /**
     * Render the checkbox column
     *
     * @param  object  $item
     *
     * @return string
     */
    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="familia_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Set the views
     *
     * @return array
     */
    public function get_views_() {
        $status_links   = array();
        $base_link      = admin_url( 'admin.php?page=sample-page' );

        foreach ($this->counts as $key => $value) {
            $class = ( $key == $this->page_status ) ? 'current' : 'status-' . $key;
            $status_links[ $key ] = sprintf( '<a href="%s" class="%s">%s <span class="count">(%s)</span></a>', add_query_arg( array( 'status' => $key ), $base_link ), $class, $value['label'], $value['count'] );
        }

        return $status_links;
    }

    /**
     * Prepare the class items
     *
     * @return void
     */
    function prepare_items() {

        $columns               = $this->get_columns();
        $hidden                = array( );
        $sortable              = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        $per_page              = 20;
        $current_page          = $this->get_pagenum();
        $offset                = ( $current_page -1 ) * $per_page;
        $this->page_status     = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '2';

        // only ncessary because we have sample data
        $args = array(
            'offset' => $offset,
            'number' => $per_page,
        );

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        $this->items  = wpfud_get_all_familia( $args );

        $this->set_pagination_args( array(
            'total_items' => wpfud_get_familia_count(),
            'per_page'    => $per_page
        ) );
    }
}