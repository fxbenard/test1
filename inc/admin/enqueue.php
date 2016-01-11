<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Load admin scripts
 *
 * @since 1.2
 */
function test_1_load_admin_script() {

  $translation_array = array(
  	'license_deactivate' => TEST_1_ITEM_NICE_NAME.' : '.__( 'License deactivate', 'test1' ),
    'ajax_fail' => __( 'Please try again soon.', 'test1' ),
  );

  wp_enqueue_script( 'test-1-script', TEST_1_ASSETS_JS_URL . 'script.js', array( 'jquery' ), '1.0.0', false );

  wp_localize_script( 'test-1-script', 'test_1_ajax', array (
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'license_deactivate'=> $translation_array,
      'ajax_fail' => $translation_array,
      'test_1_nonce' => wp_create_nonce( 'test-1-nonce' ),
  ) );

}
add_action( 'admin_enqueue_scripts', 'test_1_load_admin_script' );
