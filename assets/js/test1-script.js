jQuery(document).ready(function($) {

  /*var license = $('#test_1_license_key').val();

  if ( license != '' ) {

    $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        'action': 'test_1_check_license',
        'license': license,
      },
      beforeSend: function(reponse) {
        $('.spinner').addClass('is-active');
      },
      success: function(response) {
        $('.spinner').removeClass('is-active');
        $('#test1-reponse').html(response);
      }

    });

  }*/


  $('#test_1_license_activate').live( "click", function() {

      var license = $('#test_1_license_key').val();
      var nonce = $('#test_1_nonce').val();

      $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
          'action': 'test_1_activate_license',
          'license': license,
          'nonce': nonce,
        },
        beforeSend: function(reponse) {
          $('.spinner').addClass('is-active');
        },
        success: function(response) {
          $('.spinner').removeClass('is-active');
          $('#test1-reponse').html(response);
        }

      });

  });

  $('#test_1_license_deactivate').live( "click", function() {

    var license = $('#test_1_license_key').val();
    var nonce = $('#test_1_nonce').val();

    $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        'action': 'test_1_deactivate_license',
        'license': license,
        'nonce': nonce,
      },
      beforeSend: function(reponse) {
        $('.spinner').addClass('is-active');
      },
      success: function(response) {
        $('.spinner').removeClass('is-active');
        $('#test1-reponse').html(response);
        $('#test_1_license_key').val('');
        $('h1').after('<div class="updated"><p>' + license_deactivate.license_deactivate + '</p></div>');
      }

    });

  });

});
