<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Add admin notices
 *
 * @since 1.2
 */
add_action( 'admin_notices', 'test_1_admin_notices' );
function test_1_admin_notices() {

  $notice = get_transient('_test_1_license_error');
  $key = get_option('test_1_license_key');
  
  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'expired' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Your license key expired on %s. Please <a href="%s" target="_blank" title="Renew your license key">renew your license key</a>.', 'test1' ),
          date_i18n( get_option( 'date_format' ), strtotime( $license->expires, current_time( 'timestamp' ) ) ),
          TEST_1_STORE_URL.'/?edd_license_key=' . $key . '&utm_campaign=admin&utm_source=licenses&utm_medium=expired'
        );
      break;

      case 'missing' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Invalid license. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> and verify it.', 'test1' ),
          TEST_1_STORE_URL.'your-account?utm_campaign=admin&utm_source=licenses&utm_medium=missing'
        );
      break;

      case 'invalid' :
      case 'site_inactive' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Your %s is not active for this URL. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> to manage your license key URLs.', 'test1' ),
          TEST_1_ITEM_NICE_NAME,
          TEST_1_STORE_URL.'/your-account?utm_campaign=admin&utm_source=licenses&utm_medium=invalid'
        );
      break;

      case 'item_name_mismatch' :
        $message_class = 'error';
        $message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'test1' ), $notice );
      break;

      case 'no_activations_left':
        $message_class = 'error';
        $message = sprintf( __( 'Your license key has reached its activation limit. <a href="%s">View possible upgrades</a> now.', 'test1' ), TEST_1_STORE_URL.'/your-account' );
      break;

  	}

  	if ( ! empty( $message ) ) { ?>

  		<div class="<?php echo $message_class; ?> notice is-dismissible">
  		    <p><?php echo TEST_1_ITEM_NICE_NAME.' : ' .$message; ?></p>
  		</div>

  	<?php }

  }

}

/**
 * Return notices for AJAX
 *
 * @since 1.2
 */
function test_1_ajax_notices() {

  $notice = get_transient('_test_1_license_error');
  $key = get_option('test_1_license_key');

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'expired' :
        $message = sprintf(
          __( 'Your license key expired on %s. Please <a href="%s" target="_blank" title="Renew your license key">renew your license key</a>.', 'test1' ),
          date_i18n( get_option( 'date_format' ), strtotime( $license->expires, current_time( 'timestamp' ) ) ),
          TEST_1_STORE_URL.'/?edd_license_key=' . $key . '&utm_campaign=admin&utm_source=licenses&utm_medium=expired'
        );
      break;

      case 'missing' :
        $message = sprintf(
          __( 'Invalid license. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> and verify it.', 'test1' ),
          TEST_1_STORE_URL.'/your-account?utm_campaign=admin&utm_source=licenses&utm_medium=missing'
        );
      break;

      case 'invalid' :
      case 'site_inactive' :
        $message = sprintf(
          __( 'Your %s is not active for this URL. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> to manage your license key URLs.', 'test1' ),
          TEST_1_ITEM_NICE_NAME,
          TEST_1_STORE_URL.'/your-account?utm_campaign=admin&utm_source=licenses&utm_medium=invalid'
        );
      break;

      case 'item_name_mismatch' :
        $message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'test1' ), $notice );
      break;

      case 'no_activations_left':
        $message = sprintf( __( 'Your license key has reached its activation limit. <a href="%s">View possible upgrades</a> now.', 'test1' ), TEST_1_STORE_URL.'/your-account' );
      break;

  	}

    return $message;

  }

}
