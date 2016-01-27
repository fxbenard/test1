<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Add plugin page
 *
 * @since 1.0
 */
if ( ! function_exists( 'fx_trads_license_menu' ) ) {
	function fx_trads_license_menu() {
		add_plugins_page(
			__( 'FX Trads License Options', 'test1' ),
		 	__( 'FX Trads', 'test1' ),
			'manage_options',
			'fx-trads-license',
			'fx_trads_license_page'
		);
	}

	add_action( 'admin_menu', 'fx_trads_license_menu' );
}

/**
 * Register section / field for plugin page
 *
 * @since 1.2
 */
add_action( 'admin_init', 'test_1_license_init_page' );
function test_1_license_init_page() {
		register_setting(
			'fx_trads_license',
			'test_1_license_key',
			'test_1_sanitize_license'
		);
		add_settings_section(
			'section-test-1',
			'',
			'',
			'fx-trads-license'
		);
		add_settings_field(
			'test_1_key',
			TEST_1_ITEM_NICE_NAME,
			'test_1_key_callback',
			'fx-trads-license',
			'section-test-1'
		);
}
