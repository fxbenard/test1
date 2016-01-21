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

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'expired' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Your license key expired on %s. Please <a href="%s" target="_blank" title="Renew your license key">renew your license key</a>.', 'test1' ),
          date_i18n( get_option( 'date_format' ), strtotime( $license->expires, current_time( 'timestamp' ) ) ),
          'https://easydigitaldownloads.com/checkout/?edd_license_key=' . $value . '&utm_campaign=admin&utm_source=licenses&utm_medium=expired'
        );
      break;

      case 'missing' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Invalid license. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> and verify it.', 'test1' ),
          'https://easydigitaldownloads.com/your-account?utm_campaign=admin&utm_source=licenses&utm_medium=missing'
        );
      break;

      case 'invalid' :
      case 'site_inactive' :
        $message_class = 'error';
        $message = sprintf(
          __( 'Your %s is not active for this URL. Please <a href="%s" target="_blank" title="Visit account page">visit your account page</a> to manage your license key URLs.', 'test1' ),
          $args['name'],
          TEST_1_STORE_URL.'/your-account?utm_campaign=admin&utm_source=licenses&utm_medium=invalid'
        );
      break;

      case 'item_name_mismatch' :
        $message_class = 'error';
        $message = sprintf( __( 'This is not a %s.', 'test1' ), $args['name'] );
      break;

      case 'no_activations_left':
        $message_class = 'error';
        $message = sprintf( __( 'Your license key has reached its activation limit. <a href="%s">View possible upgrades</a> now.', 'test1' ), 'https://easydigitaldownloads.com/your-account/' );
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

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'item_name_mismatch' :
  			$message = __( 'This license does not belong to the product you have entered it for.', 'test1' );
  			break;

  		case 'no_activations_left' :
  			$message = __( 'This license does not have any activations left', 'test1' );
  			break;

  		case 'expired' :
  			$message = __( 'This license key is expired. Please renew it.', 'test1' );
  			break;

        default :
  				$message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'test1' ), $notice );
  				break;

  	}

    return $message;

  }

}
