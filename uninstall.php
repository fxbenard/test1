<?php

// If uninstall not called from WordPress exit
defined( 'WP_UNINSTALL_PLUGIN' ) or die( 'Cheatin&#8217; uh?' );

// Delete plugin transients
delete_site_transient( '_test_1_licence_data' );

// Delete plugin options
delete_site_option( 'test_1_license_key' );
delete_site_option( 'test_1_license_status' );
