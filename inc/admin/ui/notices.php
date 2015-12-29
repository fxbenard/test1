<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

add_action( 'admin_notices', 'test_1_admin_notices' );
function test_1_admin_notices() {

  $notice = get_site_transient('_test_1_licence_data');

  if( $notice !== false ) {

    switch ( $notice->license ) {

      case 'invalid' :
  			$message_class = 'error';
  			$message = __( 'This license is not valid.', 'test1' );
  			break;

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

  	}

  	if ( ! empty( $message ) ) { ?>

  		<div class="<?php echo $message_class; ?>">
  		    <p><?php echo $message; ?></p>
  		</div>

  	<?php }

  }

}
