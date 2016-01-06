<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Load admin scripts
 *
 * @since 1.2
 */
function test_1_load_admin_script() {

  $translation_array = array(
  	'license_deactivate' => __( 'License deactivate', 'test1' ),
  );

  wp_enqueue_script( 'test1-script', TEST_1_ASSETS_JS_URL . 'test1-script.js', array( 'jquery' ), '1.0.0', false );

  wp_localize_script( 'test1-script', 'Test1Ajax', array (
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'license_deactivate'=> $translation_array,
      'test_1_nonce' => wp_create_nonce( 'test-1-nonce' ),
  ) );

}
add_action( 'admin_enqueue_scripts', 'test_1_load_admin_script' );
