<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

// Delete LocalStorage on update WP settings.
add_action( 'updated_option', 'et_pb_force_regenerate_templates', 10, 3 );

// Delete LocalStorage on update Divi options.
add_action( 'wp_ajax_save_epanel', 'et_pb_force_regenerate_templates' );
