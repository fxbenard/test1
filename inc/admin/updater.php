<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

function test_1_plugin_updater() {

	// retrieve our license key from the DB
		$license_key = trim( get_option( 'test_1_license_key' ) );

		// setup the updater
		$edd_updater = new TEST_1_Plugin_Updater( TEST_1_STORE_URL, __FILE__, array(
			'version' 	=> TEST_1_VERSION,
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => TEST_1_ITEM_NAME,
			'author' 	=> 'fxbenard',
			)
		);
}
add_action( 'admin_init', 'test_1_plugin_updater', 0 );
