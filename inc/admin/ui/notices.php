<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Add admin notices
 *
 * @since 1.2
 */
add_action( 'admin_notices', 'test_2_admin_notices' );
function test_2_admin_notices() {

  $notice = get_transient('_test_2_license_error');

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'item_name_mismatch' :
  			$message_class = 'error';
  			$message = __( 'This license does not belong to the product you have entered it for.', 'fx1' );
  			break;

  		case 'no_activations_left' :
  			$message_class = 'error';
  			$message = __( 'This license does not have any activations left', 'fx1' );
  			break;

  		case 'expired' :
  			$message_class = 'error';
  			$message = __( 'This license key is expired. Please renew it.', 'fx1' );
  			break;

      default :
				$message_class = 'error';
				$message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'fx1' ), $notice );
				break;

  	}

  	if ( ! empty( $message ) ) { ?>

  		<div class="<?php echo $message_class; ?>">
  		    <p><?php echo $message; ?></p>
  		</div>

  	<?php }

  }

}

/**
 * Return notices for AJAX
 *
 * @since 1.2
 */
function test_2_ajax_notices() {

  $notice = get_transient('_test_2_license_error');

  if ( $notice !== false ) {

    switch ( $notice ) {

      case 'item_name_mismatch' :
  			$message = __( 'This license does not belong to the product you have entered it for.', 'fx1' );
  			break;

  		case 'no_activations_left' :
  			$message = __( 'This license does not have any activations left', 'fx1' );
  			break;

  		case 'expired' :
  			$message = __( 'This license key is expired. Please renew it.', 'fx1' );
  			break;

        default :
  				$message = sprintf( __( 'There was a problem activating your license key, please try again or contact support. Error code: %s', 'fx1' ), $notice );
  				break;

  	}

    return $message;

  }

}
