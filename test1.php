<?php
/**
 * Plugin Name:      EDD Test1
 * Plugin URI:      http://fxbenard.com/traductions/divi-builder-french
 * Description:     EDD Test1
 * Version: 1.0.0
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

// Rocket defines
define( 'TEST_1_VERSION'  						, '1.0.0' );
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

add_action( 'plugins_loaded', 'test_1_init' );
function test_1_init() {

	if ( ! class_exists( 'TEST_1_Plugin_Updater' ) ) {
			require ( TEST_1_CLASSES_PATH . 'TEST_1_Plugin_Updater.php' );
	}

	if ( is_admin() ) {
		require ( TEST_1_API_PATH . 'edd-software-licensing.php' );
		require ( TEST_1_ADMIN_PATH . 'options.php' );
		require ( TEST_1_ADMIN_PATH . 'enqueue.php' );
		require ( TEST_1_ADMIN_PATH . 'updater.php' );
		require ( TEST_1_ADMIN_UI_PATH . 'notices.php' );
	}


}

function test_1_sanitize_license( $new ) {

	$old = get_site_option( 'test_1_license_key' );

	if ( $old && $old != $new ) {
		delete_site_option( 'test_1_license_status' );
		delete_site_transient( '_test_1_licence_data' );
	}

	return $new;

}

/************************************
 * this illustrates how to activate
 * a license key
 *************************************/

function test_1_activate_license() {

		$license = trim($_POST['license']);
		$nonce = $_POST['nonce'];

		// run a quick security check
		if (!wp_verify_nonce ( $nonce, 'test_1_nonce' )) {
				wp_die(__('Cheatin&#8217; uh?'));
		}

		$license_data = edd_software_call( 'activate_license', $license );

		if( $license_data->license == 'valid' ) {

			update_site_option( 'test_1_license_key', $license );
			update_site_option( 'test_1_license_status', $license_data->license );
			echo test_1_action_remove_license($license_data->expires);

		} else {

			echo '<p style="color:red;"><span class="dashicons dashicons-info"></span> '. __('Licence is not valid !', 'test1') .'</p>';
		}

		die();

}
add_action( 'wp_ajax_test_1_activate_license', 'test_1_activate_license' );

/***********************************************
 * Illustrates how to deactivate a license key.
 * This will decrease the site count
 ***********************************************/

function test_1_deactivate_license() {

		$license = $_POST['license'];
		$nonce = $_POST['nonce'];
		$license_data = edd_software_call( 'deactivate_license', $license );

		// run a quick security check
		 if (!wp_verify_nonce ( $nonce, 'test_1_nonce' )) {
				wp_die(__('Cheatin&#8217; uh?'));
		}

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data->license == 'deactivated' ) {

			delete_site_option( 'test_1_license_key' );
			delete_site_option( 'test_1_license_status' );
			delete_site_transient ( '_test_1_licence_data' );

		}

		die();
}
add_action( 'wp_ajax_test_1_deactivate_license', 'test_1_deactivate_license' );


function test_1_action_add_license() { ?>

	<div style="display:table-cell; vertical-align:middle; width:20%;"><button type="button" id="test_1_license_activate" class="button-secondary"> <?php _e( 'Activate License', 'test1' ); ?></button><span class="spinner"></span></div>

<?php }

function test_1_action_remove_license( $expires ) {

			list( $date, $time ) = explode( " ", $expires );
			$day_before_expires = ceil(abs( strtotime($date) - time() ) / 86400);

		?>

			<div style="display:table-cell; vertical-align:middle; width:20%;"><span style="color: green;" class="dashicons dashicons-yes"></span> <?php _e( 'License active', 'test1' ); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><span class="dashicons dashicons-backup"></span> <?php _e('Expires in', 'test1'); ?> : <strong><?php echo $day_before_expires; ?></strong> <?php _e('days', 'test1'); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><button type="button" id="test_1_license_deactivate" class="button-secondary"><span style="vertical-align: middle;" class="dashicons dashicons-no"></span> <?php _e( 'Deactivate License', 'test1' ); ?></button><span class="spinner"></span></div>

<?php }
