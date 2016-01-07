<?php
// If uninstall not called from WordPress exit
defined( 'WP_UNINSTALL_PLUGIN' ) or die( 'Cheatin&#8217; uh?' );

// Delete plugin transients
delete_transient( '_test_1_license_data' );
delete_transient( '_test_1_license_error' );

// Delete plugin options
delete_option( 'test_1_license_key' );
delete_option( 'test_1_license_status' );
