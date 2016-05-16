$(document).on('ready' , function() {

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

      $.ajax({
        type: "POST",
        url: $data_origin + 'contact/send',
        data: $('#form-contact').serialize(),
        dataType : 'json',

        beforeSend: function() {      
          ajaxLoadingAnimation();
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
            
            $('#img-ajax-loading-1')
              .attr('src' , $data_origin + 'public/assets/img/icon_ok.png');

            var tag_msg = $('<h3>')
                                .addClass('backdrop-text-success')
                                .html(res.msg_server);

            $('#app-backdrop-content-1')
              .html(tag_msg);

            setTimeout(function() {
              $('#app-window-loading-1').fadeOut(600, function(){
                $(this).remove();
              });
            }, 3600); 

          }
          else if (res.status == 'VALIDATION_ERROR') {
            setTimeout(function(){
              $('#app-window-loading-1').fadeOut(40, function(){
                $.each(res.form_error , function(k, v){
                  if(v != '') {
                    $('#' + k)
                      .addClass('error')
                      .after(v);
                  }
                });
                $(this).remove();
              });
            }, 400);
          } 
          else if(res.status == 'ERROR_CONNECTION') {
            $('#img-ajax-loading-1')
              .attr('src' , $data_origin + 'public/assets/img/icon_error.png');

            var tag_msg = $('<h3>')
                                .addClass('backdrop-text-success')
                                .html(res.msg_server);

            $('#app-backdrop-content-1')
              .html(tag_msg);

            setTimeout(function() {
              $('#app-window-loading-1').fadeOut(600, function(){
                $(this).remove();
              });
            }, 5200);      
          }
        },

        error: function(res, textstatus, jqxhr) {
          
          $('#img-ajax-loading-1')
            .attr('src' , $data_origin + 'public/assets/img/icon_error.png');

          var tag_msg = $('<h3>')
                          .addClass('backdrop-text-success')
                          .html('Existe un error en la conexión <br/>¡Por favor, intente más tarde!');

          $('#app-backdrop-content-1')
            .html(tag_msg);

          setTimeout(function() {
            $('#app-window-loading-1').fadeOut(600, function(){
              $(this).remove();
            });
          }, 5200); 

        }
      });
    }
  });

});