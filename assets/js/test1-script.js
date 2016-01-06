jQuery(document).ready(function($) {

  $('#test_1_license_activate').live( "click", function() {


      $.ajax({
        type: "POST",
        //timeout: 15000,
        url: Test1Ajax.ajaxurl,
        data: {
          'action': 'test_1_activate_license',
          'test_1_nonce': Test1Ajax.test_1_nonce,
        },
        beforeSend: function(reponse) {
          $('#spinner-test-1').addClass('is-active');
        },
        success: function(response) {
          $('#spinner-test-1').removeClass('is-active');
          $('#test1-reponse').html(response);
        }

      });

  });

  $('#test_1_license_deactivate').live( "click", function() {


    $.ajax({
      type: "POST",
      //timeout: 15000,
      url: Test1Ajax.ajaxurl,
      data: {
        'action': 'test_1_deactivate_license',
        'test_1_nonce': Test1Ajax.test_1_nonce,
      },
      beforeSend: function(reponse) {
        $('#spinner-test-1').addClass('is-active');
      },
      success: function(response) {
        $('#spinner-test-1').removeClass('is-active');
        $('#test1-reponse').html(response);
        $('#test_1_license_key').val('');
        $('h1').after('<div class="updated"><p>' + Test1Ajax.license_deactivate.license_deactivate + '</p></div>');
      }

    });

  });

});
