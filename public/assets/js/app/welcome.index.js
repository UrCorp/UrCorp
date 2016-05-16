$(document).on('ready' , function() {

  var $window = $(window),
      $body   = $('body');

  $('#flash-overlay-modal').modal('show');

  var animationFeaturesText = [ 
    "Desarrollo de Oferta Exportable", 
    "Desarrollo de Aplicaciones Web y Móviles",
    "Imagen Corporativa" 
  ],
  animationContainer = $('#header-animation-a'),
  idx = 1;

  setInterval(function() {
    animationContainer.html('');
     
    var a = $('<div>'),
        b = $('<div>');

        a.text(animationFeaturesText[ (idx - 1) < 0 ? (animationFeaturesText.length - 1) : (idx - 1) ]) .addClass('hideUp');
        b.text(animationFeaturesText[ idx ]) .addClass('showUp');

        animationContainer
          .append(a)
          .append(b);

        idx = (idx + 1) % animationFeaturesText.length;
  }, 2000);

  $('a.anchorLink').anchorAnimate();

  var max_height_service = 0;
  $('.app-article-03 .services').each(function () { 
    max_height_service = Math.max(max_height_service, $(this).height());
  });

  $('.app-article-03 .services').each(function () { 
    $(this).css({
      'height' :  max_height_service + 'px'
    });
  });

  $('#offer-container-1, #offer-container-2').on('scrollSpy:enter', function() {
    var id = $(this).attr('id');
    $('#' + id + ' .offer-box').each(function() { 
      $(this).addClass('active');
    });
  });

  $('#offer-container-1, #offer-container-2').on('scrollSpy:exit', function() {
    var id = $(this).attr('id');
    $('#' + id + ' .offer-box').each(function() { 
      $(this).removeClass('active');
    });
  });

  $('#quienesomos-content').on('scrollSpy:enter', function() {
    var id = $(this).attr('id');
    $('#' + id + ' p').each(function() { 
      $(this).addClass('bounceInLeft');
    });
    $("#quienesomos-title").addClass('bounceInLeft');
  });
  
  $('#offer-container-1, #offer-container-2, #quienesomos-content').scrollSpy();

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