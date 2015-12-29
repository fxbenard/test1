<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

function test_1_sanitize_license( $new ) {

	$old = get_site_option( 'test_1_license_key' );

	if ( $old && $old != $new ) {
		delete_site_option( 'test_1_license_status' );
		delete_site_transient( '_test_1_licence_data' );
	}

	return $new;

}

function test_1_check_license() {

  $license = get_site_option( 'test_1_license_key' );

  if( false !== $license && !empty( $license ) ) {

    $license_data = get_site_transient( '_test_1_licence_data' );

    if( false ===  $license_data ) {

      $license_data = edd_software_call( 'check_license', $license );
      update_site_option( 'test_1_license_status', $license_data->license );

    }

  }

}
add_action( 'admin_init', 'test_1_check_license' );

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
