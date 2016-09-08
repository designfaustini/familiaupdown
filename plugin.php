<?php
/*
Plugin Name: Família Up Down
Plugin URI: http://familiaupdown.org/
Description: Sistema CRUD para cadastro de famílias do site http://familiaupdown.org/
Author: DESIGNFAUSTINI
Text Domain: Text Domain
Domain Path: Domain Path
Version: 1.0
Author URI: http://designfaustini.com/
License: GPL2
*/

add_action( 'init', function() {
	include dirname( __FILE__ ) . '/includes/class-familiaupdown-admin-menu.php';
	include dirname( __FILE__ ) . '/includes/class-familia-list-table.php';
	include dirname( __FILE__ ) . '/includes/class-form-handler.php';
	include dirname( __FILE__ ) . '/includes/familia-functions.php';
	
	new FamiliaUpDown_Admin_Menu();
} );