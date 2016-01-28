<?php
/**
 * Plugin Name:      Test1
 * Plugin URI:      https://fxbenard.com/traductions/test1
 * Description:     Test1
 * Version:      1.2.2
 * Author:      FX Bénard
 * Author URI:      https://fxbenard.com
 * Text Domain:      test1
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package         Test1
 * @author          FX Bénard <fx@fxbenard.com>
 * @copyright       Copyright (c) 2016 FX Bénard
 * @license         http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Test1 defines.
define( 'TEST_1_VERSION', '1.2.2' );
define( 'TEST_1_STORE_URL', 'https://fxbenard.com' ); // Store URL for API call.
define( 'TEST_1_ITEM_NAME', 'Test1' ); // Item Name for API call.
define( 'TEST_1_ITEM_NICE_NAME', 'Test 1' ); // Item Nice Name.
define( 'TEST_1_FILE', __FILE__ );
define( 'TEST_1_URL', plugin_dir_url( TEST_1_FILE ) );
define( 'TEST_1_PATH', realpath( plugin_dir_path( TEST_1_FILE ) ) . '/' );
define( 'TEST_1_INC_PATH', realpath( TEST_1_PATH . 'inc' ) . '/' );
define( 'TEST_1_CLASSES_PATH', realpath( TEST_1_INC_PATH . 'classes' ) . '/' );
define( 'TEST_1_ADMIN_PATH', realpath( TEST_1_INC_PATH . 'admin' ) . '/' );
define( 'TEST_1_ADMIN_UI_PATH', realpath( TEST_1_ADMIN_PATH . 'ui' ) . '/' );
define( 'TEST_1_API_PATH', realpath( TEST_1_INC_PATH . 'api' ) . '/' );
define( 'TEST_1_FUNCTIONS_PATH', realpath( TEST_1_INC_PATH . 'functions' ) . '/' );
define( 'TEST_1_ASSETS_URL',  TEST_1_URL . 'assets/' );
define( 'TEST_1_ASSETS_JS_URL', TEST_1_ASSETS_URL . 'js/' );
define( 'TEST_1_ASSETS_CSS_URL', TEST_1_ASSETS_URL . 'css/' );
define( 'TEST_1_ASSETS_IMG_URL', TEST_1_ASSETS_URL . 'img/' );

/**
 * Tell WP what to do when plugin is loaded
 *
 * @since 1.2
 */
function test_1_init() {

	// Load translations.
	load_plugin_textdomain( 'test1', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	if ( is_admin() ) {

		if ( ! class_exists( 'TEST_1_Plugin_Updater' ) ) {
				require( TEST_1_CLASSES_PATH . 'TEST_1_Plugin_Updater.php' );
		}

		require( TEST_1_ADMIN_PATH . 'options.php' );
		require( TEST_1_ADMIN_PATH . 'enqueue.php' );
		require( TEST_1_ADMIN_UI_PATH . 'options.php' );
		require( TEST_1_ADMIN_UI_PATH . 'actions.php' );
		require( TEST_1_ADMIN_UI_PATH . 'notices.php' );
		require( TEST_1_API_PATH . 'edd-software-licensing.php' );
		require( TEST_1_FUNCTIONS_PATH . 'license.php' );

	}

}
add_action( 'plugins_loaded', 'test_1_init' );

/**
 * Setup the updater
 *
 * @since 1.0
 */
function test_1_plugin_updater() {

		$license_key = trim( get_option( 'test_1_license_key' ) );

		// Setup the updater.
		$edd_updater = new TEST_1_Plugin_Updater( TEST_1_STORE_URL, __FILE__, array(
			'version' 	=> TEST_1_VERSION,
			'license' 	=> $license_key, 		// License key (used get_option above to retrieve from DB).
			'item_name' => TEST_1_ITEM_NAME,
			'author' 	=> 'fxbenard',
			)
		);

}
add_action( 'admin_init', 'test_1_plugin_updater', 0 );


$license = get_option( 'test_1_license_key' );
$status = get_option( 'test_1_license_status' );
if ( $license !== false && $status == 'valid' ) {
	// ADD YOUR STUFF HERE.
}
