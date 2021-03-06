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

			list( $date, $time ) = explode( " ", $expires );
			$day_before_expires = ceil(abs( strtotime($date) - time() ) / 86400);

		?>

			<div style="display:table-cell; vertical-align:middle; width:20%;"><span style="color: green;" class="dashicons dashicons-yes"></span> <?php _e( 'License active', 'test1' ); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><span class="dashicons dashicons-backup"></span> <?php _e('Expires in', 'test1'); ?> : <strong><?php echo $day_before_expires; ?></strong> <?php _e('days', 'test1'); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><button type="button" id="test_2_license_deactivate" class="button-secondary"><span style="vertical-align: middle;" class="dashicons dashicons-no"></span> <?php _e( 'Deactivate License', 'test1' ); ?></button><span id="spinner-test-1" class="spinner"></span></div>

<?php }
