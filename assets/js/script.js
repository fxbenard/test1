jQuery(document).ready(function($) {

  $('#test_1_license_activate').live( "click", function() {

      $.ajax({
        type: "POST",
        timeout: 30000,
        url: test_1_ajax.ajaxurl,
        data: {
          'action': 'test_1_activate_license',
          'test_1_nonce': test_1_ajax.test_1_nonce,
        },
        beforeSend: function(reponse) {
          $('#spinner-test-1').addClass('is-active');
        },
        success: function(response) {
          $('#spinner-test-1').removeClass('is-active');
          $('#test-1-reponse').html(response);
        },
        fail: function() {
          $('h1').after('<div class="error"><p>' + test_1_ajax.ajax_fail.ajax_fail + '</p></div>');
        }

      });

  });

  $('#test_1_license_deactivate').live( "click", function() {

    $.ajax({
      type: "POST",
      timeout: 30000,
      url: test_1_ajax.ajaxurl,
      data: {
        'action': 'test_1_deactivate_license',
        'test_1_nonce': test_1_ajax.test_1_nonce,
      },
      beforeSend: function(reponse) {
        $('#spinner-test-1').addClass('is-active');
      },
      success: function(response) {
        $('#spinner-test-1').removeClass('is-active');
        $('#test-1-reponse').html(response);
        $('#test_1_license_key').val('');
        $('h1').after('<div class="updated notice is-dismissible"><p>' + test_1_ajax.license_deactivate.license_deactivate + '</p></div>');
      },
      fail: function() {
        $('h1').after('<div class="error"><p>' + test_1_ajax.ajax_fail.ajax_fail + '</p></div>');
      }
    });

  });

});
