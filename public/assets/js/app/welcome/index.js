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
    submitHandler : function(form) {
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
              .loading( 'toggle' )
              .loading({
                theme: 'dark',
                message: res.msg_server,
                onStart: function(loading) {
                  loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                  loading.overlay.slideUp(400);
                }
              });
            setTimeout( function ( ) { 
              $body.loading( 'stop' ); 
            }, 3200); 

          }
          else if (res.status == 'VALIDATION_ERROR') {
            setTimeout(function(){
              $body
                .loading('stop');

              $.each(res.form_error , function(element, message){
                if(message != '') {
                  $('#' + element)
                    .addClass('error')
                    .after('<label class="error" for="'+element+'" style="display: block;">'+message+'</label>');
                }
              });
            }, 400);
          } 
          else if(res.status == 'ERROR_CONNECTION') {
            $body
              .loading( 'toggle' )
              .loading({
                theme: 'dark',
                message: res.msg_server,
                onStart: function(loading) {
                  loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                  loading.overlay.slideUp(400);
                }
              });
            setTimeout( function ( ) { 
              $body.loading( 'stop' ); 
            }, 3200);     
          }
        },

        error: function(res, textstatus, jqxhr) {
          $body
            .loading( 'toggle' )
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
            $body.loading( 'stop' ); 
          }, 3200);
        }
      });
    }
  });
});