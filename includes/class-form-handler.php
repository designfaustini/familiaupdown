<?php

/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class Form_Handler {

    /**
     * Hook 'em all
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'handle_form' ) );
    }

    /**
     * Handle the familia new and edit form
     *
     * @return void
     */
    public function handle_form() {
        if ( ! isset( $_POST['submit_familia'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'familia-new' ) ) {
            die( __( 'Are you cheating?', 'designfaustini' ) );
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'designfaustini' ) );
        }

        $errors   = array();
        $page_url = admin_url( 'admin.php?page=familiaupdown' );
        $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

        $nome_pai = isset( $_POST['nome_pai'] ) ? sanitize_text_field( $_POST['nome_pai'] ) : '';
        $nome_mae = isset( $_POST['nome_mae'] ) ? sanitize_text_field( $_POST['nome_mae'] ) : '';
        $nome_updown = isset( $_POST['nome_updown'] ) ? sanitize_text_field( $_POST['nome_updown'] ) : '';
        $qtd_irmao = isset( $_POST['qtd_irmao'] ) ? sanitize_text_field( $_POST['qtd_irmao'] ) : '';
        $end = isset( $_POST['end'] ) ? wp_kses_post( $_POST['end'] ) : '';
        $cep = isset( $_POST['cep'] ) ? sanitize_text_field( $_POST['cep'] ) : '';
        $cidade = isset( $_POST['cidade'] ) ? sanitize_text_field( $_POST['cidade'] ) : '';
        $uf = isset( $_POST['uf'] ) ? sanitize_text_field( $_POST['uf'] ) : '';
        $pais = isset( $_POST['pais'] ) ? sanitize_text_field( $_POST['pais'] ) : '';
        $telefone = isset( $_POST['telefone'] ) ? sanitize_text_field( $_POST['telefone'] ) : '';
        $email = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';

        // some basic validation
        if ( ! $nome_pai ) {
            $errors[] = __( 'Error: Pai Up Down is required', 'designfaustini' );
        }

        if ( ! $nome_mae ) {
            $errors[] = __( 'Error: Mãe Up Down is required', 'designfaustini' );
        }

        if ( ! $nome_updown ) {
            $errors[] = __( 'Error: Filho(a) Up Down is required', 'designfaustini' );
        }

        if ( ! $end ) {
            $errors[] = __( 'Error: Endereço is required', 'designfaustini' );
        }

        if ( ! $cep ) {
            $errors[] = __( 'Error: CEP is required', 'designfaustini' );
        }

        if ( ! $cidade ) {
            $errors[] = __( 'Error: Cidade is required', 'designfaustini' );
        }

        if ( ! $uf ) {
            $errors[] = __( 'Error: Estdao is required', 'designfaustini' );
        }

        if ( ! $pais ) {
            $errors[] = __( 'Error: País is required', 'designfaustini' );
        }

        if ( ! $telefone ) {
            $errors[] = __( 'Error: Telefone is required', 'designfaustini' );
        }

        if ( ! $email ) {
            $errors[] = __( 'Error: E-mail is required', 'designfaustini' );
        }

        // bail out if error found
        if ( $errors ) {
            $first_error = reset( $errors );
            $redirect_to = add_query_arg( array( 'error' => $first_error ), $page_url );
            wp_safe_redirect( $redirect_to );
            exit;
        }

        $fields = array(
            'nome_pai' => $nome_pai,
            'nome_mae' => $nome_mae,
            'nome_updown' => $nome_updown,
            'qtd_irmao' => $qtd_irmao,
            'end' => $end,
            'cep' => $cep,
            'cidade' => $cidade,
            'uf' => $uf,
            'pais' => $pais,
            'telefone' => $telefone,
            'email' => $email,
        );

        // New or edit?
        if ( ! $field_id ) {

            $insert_id = wpfud_insert_familia( $fields );

        } else {

            $fields['id'] = $field_id;

            $insert_id = wpfud_insert_familia( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        wp_safe_redirect( $redirect_to );
        exit;
    }
}

new Form_Handler();