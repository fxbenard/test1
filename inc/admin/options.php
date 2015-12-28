<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Add plugin page
if ( ! function_exists( 'fx_trads_license_menu' ) ) {
	function fx_trads_license_menu() {
		add_plugins_page( __( 'FX Trads License Options', 'test1' ), __( 'FX Trads', 'test1' ), 'manage_options', 'fx-trads-license', 'fx_trads_license_page' );
	}

	add_action( 'admin_menu', 'fx_trads_license_menu' );
}

add_action( 'admin_init', 'test_1_license_init_page' );
function test_1_license_init_page() {
		register_setting( 'test_1_license', 'test_1_license_key', 'test_1_sanitize_license' );
		add_settings_section( 'section-test1',   '', 'section_licenses_callback',  'fx-trads-license' );
		add_settings_field( 'test_1_key',  esc_html__( 'Test-1',  'test1' ), 'test_1_key_callback', 'fx-trads-license', 'section-test1' );
}

function section_licenses_callback() {
}

function test_1_key_callback() {

	$license = get_site_option( 'test_1_license_key' );
	$status = get_site_option( 'test_1_license_status' );


  ?>
	<?php wp_nonce_field( 'test_1_nonce', 'test_1_nonce' ); ?>
  <label>
		<input type="text" id="test_1_license_key" class="regular-text" name="test_1_license_key" value="<?php echo esc_attr__( $license ); ?>"/>
		<span style="vertical-align: middle;" class="dashicons dashicons-admin-network"></span> <?php echo __( 'Enter your license key', 'test1' ); ?>
	</label>

		<div id="test1-reponse" style="width:600px; padding-top:1em;">

			<?php

				if( $license !== false && $status !== false ) {

					$license_data = get_site_transient( '_test_1_licence_data' );

					if( $license_data === false ) {

							$license_data = edd_software_call( 'check_license', $license );

					}

					echo test_1_action_remove_license( $license_data->expires );

				} else {

					echo test_1_action_add_license();

				}

			?>
		</div>

  <?php

}

// IDEM ALL PLUGINS
if ( ! function_exists( 'fx_trads_license_page' ) ) {
	function fx_trads_license_page() {
		global $title;
		?>

		<div class="wrap">
			<h1><?php echo $title; ?></h1>

			<form action="options.php" method="POST">

					<?php settings_fields( 'test_1_license' ); ?>
					<?php do_settings_sections( 'fx-trads-license' ); ?>
					<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
