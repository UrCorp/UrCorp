$(document).on('ready' , function() {

  var $window = $(window),
      $body = $('body'),
      $header = $('#header'),
      $navbar = $('#navbar'),
      $itemsContainer = $('#items-container');

  if (window.innerWidth < 768) {
    $navbar.addClass('app-navbar-fixed');
  }

  $(window).resize(function() {
    if (window.innerWidth < 768) {
      $navbar.addClass('app-navbar-fixed');
    } else {
      $navbar.removeClass('app-navbar-fixed');
    }
  });

  $window.scroll(function() {
    var limit = $header.position().top + $header.height();

    if ($window.scrollTop() > limit || window.innerWidth < 768) {
      $navbar.addClass('app-navbar-fixed');
    } else {
      $navbar.removeClass('app-navbar-fixed');
    }
  });

  $('.item', $itemsContainer).click(function(event) {
    var $this = $(this);

    $this.toggleClass('bounce bounceIn active');
  });

  $('#form-contact').validate({
    rules: {
      "contact[name]": {
        required: true,
        maxlength: 60
      },
      "contact[email]": {
        required: true,
        email: true,
        maxlength: 250
      },
      "contact[phone]": {
        required: true,
        regex: /^[0-9]{10,10}$/
      },
      "contact[msg]": {
        maxlength: 60
      }
    },
    messages: {
      "contact[name]": {
        required: "Por favor, introduzca su nombre."
      },
      "contact[email]": {
        required: "Por favor, introduzca su correo electrónico.",
        email: "Correo electrónico inválido.",
      },
      "contact[phone]": {
        required: "Por favor, introduzca su número de teléfono o celular.",
        regex: "El número telefónico únicamente debe estar conformado por dígitos."
      }
    },
    submitHandler: function(form) {
      alert("Validated");
      var $form = $(form);
      $.ajax({
        type: "POST",
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType : 'json',

        beforeSend: function() { 
          $body.loading({
            message: "Cargando...",
            theme: 'dark',
            onStart: function(loading) {
              loading.overlay.slideDown(400);
            },
            onStop: function(loading) {
              loading.overlay.slideUp(400);
            }
          });
        },
        success: function(res) {
          if (res.status == 'SUCCESS') {
            $('#form-contact input, #form-contact textarea').each(function() {
              var e = $(this);

              if(e.attr('type') != 'hidden') {
                e.val('').removeClass('error');
              }
            });

            $('#form-contact label.error').each(function() {
              $(this).remove();
            });
            
            $body
              .loading('toggle')
              .loading({
                theme: 'dark',
                message: res.msg,
                onStart: function(loading) {
                  loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                  loading.overlay.slideUp(400);
                }
              });
            setTimeout( function ( ) { 
              $body.loading('stop'); 
            }, 3200); 

          }
          else if (res.status == 'VALIDATION_ERROR') {
            $body
              .loading('toggle')
              .loading({
                theme: 'dark',
                message: res.msg,
                onStart: function(loading) {
                  loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                  loading.overlay.slideUp(400);
                }
              });
            setTimeout( function ( ) { 
              $body.loading('stop'); 
            }, 3200); 
          } 
          else if(res.status == 'ERROR_CONNECTION') {
            $body
              .loading('toggle')
              .loading({
                theme: 'dark',
                message: res.msg,
                onStart: function(loading) {
                  loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                  loading.overlay.slideUp(400);
                }
              });
            setTimeout( function ( ) { 
              $body.loading('stop'); 
            }, 3200);     
          }
        },
        error: function(res, textstatus, jqxhr) {
          $body
            .loading('toggle')
            .loading({
              theme: 'dark',
              message: 'Existe un error en la conexión <br/>¡Por favor, intente más tarde!',
              onStart: function(loading) {
                loading.overlay.slideDown(400);
              },
              onStop: function(loading) {
                loading.overlay.slideUp(400);
              }
            });
          setTimeout( function ( ) { 
            $body.loading('stop'); 
          }, 3200);
        }
      });
      return false;
    }
  });
});