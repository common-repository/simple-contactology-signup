<?php
/*
Plugin Name: Simple Contactology Signup
Plugin URL:
Description: Display a signup form for any Contactology email list
Version: 1.0
Author: Pippin Williamson and Contactology
Author URI: http://contactology.com
Contributors: mordauk, contactology
*/

/**************************************************
* CONSTANTS
**************************************************/

if ( !defined( 'SCS_PLUGIN_DIR' ) ) {
	define( 'SCS_PLUGIN_DIR', dirname( __FILE__ ) );
}


/**************************************************
* languages
**************************************************/

function scs_load_textdomain() {
	load_plugin_textdomain( 'contactology', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'scs_load_textdomain' );

/**************************************************
* includes
**************************************************/

include_once SCS_PLUGIN_DIR . '/includes/settings.php';
include_once SCS_PLUGIN_DIR . '/includes/functions.php';
include_once SCS_PLUGIN_DIR . '/includes/widgets.php';
include_once SCS_PLUGIN_DIR . '/includes/signup-form.php';