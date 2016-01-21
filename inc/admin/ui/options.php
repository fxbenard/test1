<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Callback function for test_1_key field
 *
 * @since 1.2
 */
function test_1_key_callback() {

	$license = get_option( 'test_1_license_key' );
	$status = get_option( 'test_1_license_status' );

	?>

  <label>
		<input type="text" id="test_1_license_key" class="regular-text" name="test_1_license_key" value="<?php echo esc_attr( $license ); ?>"/>
		<span style="vertical-align: middle;" class="dashicons dashicons-admin-network"></span> <?php echo __( 'Enter your license key', 'test1' ); ?>
	</label>

		<div id="test-1-reponse" style="width:700px; padding-top:1em;">

			<?php

				if ( false !== $license ) {

					if ( $status !== false && $status == 'valid' ) {

						$license_data = get_transient( '_test_1_license_data' );
						echo test_1_action_remove_license( $license_data->expires );


					} elseif ( $status === false OR $status != 'invalid' ) {

						echo test_1_action_add_license();

					}

				}

			?>

		</div>

<?php }

/**
 * Callback function for add_plugins_page
 *
 * @since 1.2
 */
if ( ! function_exists( 'fx_trads_license_page' ) ) {

	function fx_trads_license_page() {

		global $title;

		?>

		<div class="wrap">
			<h1><?php echo $title; ?></h1>

			<form action="options.php" method="POST">

					<?php settings_fields( 'fx_trads_license' ); ?>
					<?php do_settings_sections( 'fx-trads-license' ); ?>
					<?php submit_button(); ?>
			</form>

		</div>

		<?php
	}
}
