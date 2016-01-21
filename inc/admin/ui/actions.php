<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Ouput Activate license button
 *
 * @since 1.2
 */
function test_1_action_add_license() { ?>

	<div style="display:table-cell; vertical-align:middle; width:20%;"><button type="button" id="test_1_license_activate" class="button-secondary"> <?php _e( 'Activate License', 'test1' ); ?></button><span id="spinner-test-1" class="spinner"></span></div>

<?php }

/**
 * Ouput Dectivate license button and license informations
 *
 * @since 1.2
 */
function test_1_action_remove_license( $expires ) {

	$now        = current_time( 'timestamp' );
	$expiration = strtotime( $expires, current_time( 'timestamp' ) );

	if( 'lifetime' === $expires ) {
		$expiration_message = __( 'License key never expires.', 'test1' );
	} elseif( $expiration > $now && $expiration - $now < ( DAY_IN_SECONDS * 30 ) ) {
		$expiration_message = sprintf(
			__( 'Your license key expires soon! It expires on %s. <a href="%s" target="_blank" title="Renew license">Renew your license key</a>.', 'test1' ),
			date_i18n( get_option( 'date_format' ), strtotime( $expires, current_time( 'timestamp' ) ) ),
			'#'
		);
	} else {
		$expiration_message = sprintf(
			__( 'Your license key expires on %s.', 'test1' ),
			date_i18n( get_option( 'date_format' ), strtotime( $expires, current_time( 'timestamp' ) ) )
		);
	}

	?>
		<div style="display:flex; align-items:center;">
		<div><span style="color: green;" class="dashicons dashicons-yes"></span> <?php _e( 'License active', 'test1' ); ?></div>
		<div><span class="dashicons dashicons-backup"></span> <?php echo $expiration_message; ?></strong></div>
		<div><button type="button" id="test_2_license_deactivate" class="button-secondary"><span style="vertical-align: middle;" class="dashicons dashicons-no"></span> <?php _e( 'Deactivate License', 'test1' ); ?></button><span id="spinner-test-1" class="spinner"></span></div>
	</div>
	
<?php }
