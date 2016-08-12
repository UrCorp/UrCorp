var $data_origin = undefined,
    $window      = undefined,
    $body        = undefined;


Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

function attrCSSToJSON(stringCSS) {
  stringCSS.replace(/\s+/g, "");
  var attrValue   = stringCSS.split(";"),
    objJSON   = "{"; 

  for( var i = 0; i < attrValue.length; ++i ) {
    var t = attrValue[i].split(":");
    objJSON += "\"" +t[0] + "\":" + "\"" + t[1] + "\"";

    if( i != ( attrValue.length - 1 ) ) {
      if( ( i + 1 ) < attrValue.length ) {
        if( attrValue[i + 1] == "" ) {
          break;
        } 
      }
      objJSON += ",";
    }
  }
  objJSON += "}";
  return objJSON;
}

$.fn.adjustStyle = function( ) {
  return this.each ( function ( ) {
    var $this = $( this ),
      styles = $this.attr('data-styles');
    if( typeof styles != "undefined" && styles != "" ) {
      styles = jQuery.parseJSON( attrCSSToJSON( styles ) );
      var x;

      $.each ( styles, function ( k, v ) {
        x = v; 
        if( k == 'width') { 
          x = ( ( $( window ).width() * v ) / 100 ) + 'px';
        }
        else if( k == 'height' || 
             k == 'min-height' ||
             k == 'margin-top') {
          x = ( ( ( $( window ).height() * v ) / 100 ) + 1 ) + 'px';
        }
        $this.css( k, x );
      });
    }
  });
}

$(document).on('ready', function() {

  $data_origin  = $('body').attr('data-origin');
  $window       = $(window);
  $body         = $('body');

  $('#flash-overlay-modal').modal('show');
  
  $('[data-toggle="tooltip"]').each(function() {
    $(this).data('placement', (($window.width() <= 480) ? 'top' : 'right'));
  });

  $('[data-toggle="tooltip"]')
    .data('placement', (($window.width() <= 480) ? 'top' : 'right'))
    .tooltip();

  $('body').on('activate.bs.scrollspy', function () {
      var activeSection =  $( this ).find("li.active a").attr("href");
      if( activeSection == '#inicio') {
        $('#main-navbar').removeClass('app-navbar-two');
      }
      if (activeSection == '#quienesomos' ||
         activeSection == '#estrategia'  ||
         activeSection == '#servicios'   ||
         activeSection == '#clientes'    ||
         activeSection == '#contacto') {
        $('#main-navbar').addClass('app-navbar-two');
      }
  });

  $('[data-adjust-style="true"]').adjustStyle();
  $( window ).resize( function ( ) {
    $('[data-adjust-style="true"]').adjustStyle();
  });
});
