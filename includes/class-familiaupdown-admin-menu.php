<?php

/**
 * Admin Menu
 */
class FamiliaUpDown_Admin_Menu {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {

        /** Top Menu **/
        add_menu_page( __( 'Família Up Down', 'designfaustini' ), __( 'Família Up Down', 'designfaustini' ), 'manage_options', 'familiaupdown', array( $this, 'plugin_page' ), 'dashicons-groups', null );

        add_submenu_page( 'familiaupdown', __( 'Família Up Down', 'designfaustini' ), __( 'Família Up Down', 'designfaustini' ), 'manage_options', 'familiaupdown', array( $this, 'plugin_page' ) );
    }

    /**
     * Handles the plugin page
     *
     * @return void
     */
    public function plugin_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ($action) {
            case 'view':

                $template = dirname( __FILE__ ) . '/views/familia-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views/familia-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views/familia-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/views/familia-list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }
    }
}