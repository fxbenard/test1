<?php
/**
 * Plugin Name:      EDD Test1
 * Plugin URI:      http://fxbenard.com/traductions/divi-builder-french
 * Description:     EDD Test1
 * Version: 1.2
 * Author:          FX Bénard
 * Author URI:      https://fxbenard.com
 * Text Domain:     test1
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
 * @copyright       Copyright (c) 2015 FX Bénard
 * @license         http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Test1 defines
define( 'TEST_1_VERSION'  						, '1.2' );
define( 'TEST_1_STORE_URL'						, 'https://fxbenard.com' ); // Store URL for API call
define( 'TEST_1_ITEM_NAME'						, 'Test1' ); // Item Name for API call
define( 'TEST_1_FILE'    							, __FILE__ );
define( 'TEST_1_URL'    							, plugin_dir_url( TEST_1_FILE ) );
define( 'TEST_1_PATH'    							, realpath( plugin_dir_path( TEST_1_FILE ) ) . '/' );
define( 'TEST_1_INC_PATH'    					, realpath( TEST_1_PATH . 'inc' ) . '/' );
define( 'TEST_1_CLASSES_PATH'    			, realpath( TEST_1_INC_PATH . 'classes' ) . '/' );
define( 'TEST_1_ADMIN_PATH'    				, realpath( TEST_1_INC_PATH . 'admin' ) . '/' );
define( 'TEST_1_ADMIN_UI_PATH'    		, realpath( TEST_1_ADMIN_PATH . 'ui' ) . '/' );
define( 'TEST_1_API_PATH'    					, realpath( TEST_1_INC_PATH . 'api' ) . '/' );
define( 'TEST_1_FUNCTIONS_PATH'    		, realpath( TEST_1_INC_PATH . 'functions' ) . '/' );
define( 'TEST_1_ASSETS_URL'    				,  TEST_1_URL . 'assets/' );
define( 'TEST_1_ASSETS_JS_URL'    		, TEST_1_ASSETS_URL . 'js/' );


/**
 * Tell WP what to do when plugin is loaded
 *
 * @since 1.2
 */
add_action( 'plugins_loaded', 'test_1_init' );
function test_1_init() {

	if ( is_admin() ) {

		if ( ! class_exists( 'TEST_1_Plugin_Updater' ) ) {
				require ( TEST_1_CLASSES_PATH . 'TEST_1_Plugin_Updater.php' );
		}

		require ( TEST_1_ADMIN_PATH . 'updater.php' );
		require ( TEST_1_ADMIN_PATH . 'options.php' );
		require ( TEST_1_ADMIN_PATH . 'enqueue.php' );
		require ( TEST_1_ADMIN_UI_PATH . 'actions.php' );
		require ( TEST_1_ADMIN_UI_PATH . 'notices.php' );
		require ( TEST_1_API_PATH . 'edd-software-licensing.php' );
		require ( TEST_1_FUNCTIONS_PATH . 'license.php' );

	}

}
