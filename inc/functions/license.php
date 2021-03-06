<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Delete options and transients when a new key is submitted
 *
 * @since 1.0
 */
function test_1_sanitize_license( $new ) {

	$old = get_option( 'test_1_license_key' );

	if ( $old && $old != $new ) {
		delete_option( 'test_1_license_status' );
		delete_transient( '_test_1_license_data' );
		delete_transient( '_test_1_license_error' );
	}

	return $new;

}

/**
 * Check the EDD API for license statut check if transient exist
 *
 * @since 1.2
 */
function test_1_check_license() {

  $license = trim( get_option( 'test_1_license_key' ) );
  $status = get_option( 'test_1_license_status' );

  if ( false !== $license && !empty( $license ) ) {

    $license_data = get_transient( '_test_1_license_data' );

    if ( false ===  $license_data ) {

      $license_data = test_1_edd_software_call( 'check_license', $license );

			if ( $license_data->license == 'invalid' ) {

				set_transient( '_test_1_license_error', $license_data->license );
				update_option( 'test_1_license_status', 'invalid' );

			} elseif ( $license_data->license == 'valid' ) {

				set_transient( '_test_1_license_data', $license_data, DAY_IN_SECONDS );

			}

    }

  }

}
add_action( 'admin_init', 'test_1_check_license' );

/**
 * Activate license
 *
 * @since 1.2
 */
function test_1_activate_license() {

		$license = trim ( get_option( 'test_1_license_key' ) );
		$nonce = $_POST['test_1_nonce'];

		// run a quick security check
		if ( ! wp_verify_nonce( $nonce, 'test-1-nonce' ) ) {
			wp_die( __( 'Cheatin&#8217; uh?', 'test1' ) );
		}

		$license_data = test_1_edd_software_call( 'activate_license', $license );

		update_option( 'test_1_license_status', $license_data->license );

		if ( $license_data->license == 'valid' ) {

	    set_transient( '_test_1_license_data', $license_data, DAY_IN_SECONDS );
			delete_transient( '_test_1_license_error' );
			echo test_1_action_remove_license($license_data->expires);

		} else {

			set_transient( '_test_1_license_error', $license_data->error );
			echo '<p style="color:red;"><span class="dashicons dashicons-info"></span> '. test_1_ajax_notices() .'</p>';

    }

		die();

}
add_action( 'wp_ajax_test_1_activate_license', 'test_1_activate_license' );

/**
 * Deactivate license
 *
 * @since 1.2
 */
function test_1_deactivate_license() {

	  $license = trim ( get_option( 'test_1_license_key' ) );
		$nonce = $_POST['test_1_nonce'];

		// run a quick security check
		if ( ! wp_verify_nonce( $nonce, 'test-1-nonce' ) ) {
			wp_die( __( 'Cheatin&#8217; uh?', 'test1' ) );
		}

		$license_data = test_1_edd_software_call( 'deactivate_license', $license );

		if ( $license_data->license == 'deactivated' ) {

			delete_option( 'test_1_license_key' );
			delete_option( 'test_1_license_status' );
			delete_transient ( '_test_1_license_data' );
			delete_transient ( '_test_1_license_error' );

		}

		die();
}
add_action( 'wp_ajax_test_1_deactivate_license', 'test_1_deactivate_license' );
