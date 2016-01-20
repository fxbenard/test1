<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Add admin notices
 *
 * @since 1.2
 */
add_action( 'admin_notices', 'test_1_admin_notices' );
function test_2_admin_notices() {

  $notice = get_transient('_test_1_license_error');

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'item_name_mismatch' :
  			$message_class = 'error';
  			$message = __( 'This license does not belong to the product you have entered it for.', 'test1' );
  			break;

  		case 'no_activations_left' :
  			$message_class = 'error';
  			$message = __( 'This license does not have any activations left', 'test1' );
  			break;

  		case 'expired' :
  			$message_class = 'error';
  			$message = __( 'This license key is expired. Please renew it.', 'test1' );
  			break;

      default :
				$message_class = 'error';
				$message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'test1' ), $notice );
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
