<?php

/**
 * Get all familia
 *
 * @param $args array
 *
 * @return array
 */
function wpfud_get_all_familia( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'ASC',
    );

    $args      = wp_parse_args( $args, $defaults );
    $cache_key = 'familia-all';
    $items     = wp_cache_get( $cache_key, 'designfaustini' );

    if ( false === $items ) {
        $items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'familiaupdown ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

        wp_cache_set( $cache_key, $items, 'designfaustini' );
    }

    return $items;
}

/**
 * Fetch all familia from database
 *
 * @return array
 */
function wpfud_get_familia_count() {
    global $wpdb;

    return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'familiaupdown' );
}

/**
 * Fetch a single familia from database
 *
 * @param int   $id
 *
 * @return array
 */
function wpfud_get_familia( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'familiaupdown WHERE id = %d', $id ) );
}

/**
 * Insert a new familia
 *
 * @param array $args
 */
function wpfud_insert_familia( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id'         => null,
        'nome_pai' => '',
        'nome_mae' => '',
        'nome_updown' => '',
        'qtd_irmao' => '',
        'end' => '',
        'cep' => '',
        'cidade' => '',
        'uf' => '',
        'pais' => '',
        'telefone' => '',
        'email' => '',

    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'familiaupdown';

    // some basic validation
    if ( empty( $args['nome_pai'] ) ) {
        return new WP_Error( 'no-nome_pai', __( 'No Pai Up Down provided.', 'designfaustini' ) );
    }
    if ( empty( $args['nome_mae'] ) ) {
        return new WP_Error( 'no-nome_mae', __( 'No Mãe Up Down provided.', 'designfaustini' ) );
    }
    if ( empty( $args['nome_updown'] ) ) {
        return new WP_Error( 'no-nome_updown', __( 'No Filho(a) Up Down provided.', 'designfaustini' ) );
    }
    if ( empty( $args['end'] ) ) {
        return new WP_Error( 'no-end', __( 'No Endereço provided.', 'designfaustini' ) );
    }
    if ( empty( $args['cep'] ) ) {
        return new WP_Error( 'no-cep', __( 'No CEP provided.', 'designfaustini' ) );
    }
    if ( empty( $args['cidade'] ) ) {
        return new WP_Error( 'no-cidade', __( 'No Cidade provided.', 'designfaustini' ) );
    }
    if ( empty( $args['uf'] ) ) {
        return new WP_Error( 'no-uf', __( 'No Estdao provided.', 'designfaustini' ) );
    }
    if ( empty( $args['pais'] ) ) {
        return new WP_Error( 'no-pais', __( 'No País provided.', 'designfaustini' ) );
    }
    if ( empty( $args['telefone'] ) ) {
        return new WP_Error( 'no-telefone', __( 'No Telefone provided.', 'designfaustini' ) );
    }
    if ( empty( $args['email'] ) ) {
        return new WP_Error( 'no-email', __( 'No E-mail provided.', 'designfaustini' ) );
    }

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];
    unset( $args['id'] );

    if ( ! $row_id ) {

        $args['date'] = current_time( 'mysql' );

        // insert a new
        if ( $wpdb->insert( $table_name, $args ) ) {
            return $wpdb->insert_id;
        }

    } else {

        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}

/** SHORTCODE FRONT-END FORM **/
function add_form( $attrs ) {
	if(include('/views/familia-new.php'))
	return'';
}

add_shortcode('wpfud','add_form');
