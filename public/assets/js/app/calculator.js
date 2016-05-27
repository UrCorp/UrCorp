var total = 0;

function calcularTotal ($container, $list, settings) {
  var subtotal = 0;

  $('.btn-calc-features.active', settings.features).each(function () {
    var $feature = $(this);
    var tmpSearch = JSON.search(settings.allItems, '//platform_features[id="'+$feature.data('value')+'"]/price')[0];

    $('.btn-calc-platform.active', settings.types).each(function () {
      var $platform = $(this);
      var tmpPrice = tmpSearch[$platform.data('value')];
      subtotal += tmpPrice;
    });
  });

  $('.btn-calc-admin-features.active', settings.admin_features).each(function () {
    var $feature = $(this);
    var tmpSearch = JSON.search(settings.allItems, '//admin_features[id="'+$feature.data('value')+'"]/price')[0];

    $('.btn-calc-platform.active', settings.types).each(function () {
      var $platform = $(this);
      var tmpPrice = tmpSearch[$platform.data('value')];
      subtotal += tmpPrice;
    });
  });

  total = subtotal;
  $('.calc-total-cant', $container).text('$'+total.format(2));
}

function calculate ($container, $list, settings, $feature, feature_type) {
  var price = 0;
  if (typeof $feature === "undefined") {

    $('.btn-calc-features.active', settings.features).each(function () {
      var $feature = $(this);
      var tmpSearch = JSON.search(settings.allItems, '//platform_features[id="'+$feature.data('value')+'"]/price')[0];
      price = 0;

      $('.btn-calc-platform.active', settings.types).each(function () {
        var $platform = $(this);
        var tmpPrice = tmpSearch[$platform.data('value')];
        price += tmpPrice;
      });

      $('.cf-price', '#cf-' + $feature.data('value') ).text('$'+price.format(2));
    });

    $('.btn-calc-admin-features.active', settings.admin_features).each(function () {
      var $feature = $(this);
      var tmpSearch = JSON.search(settings.allItems, '//admin_features[id="'+$feature.data('value')+'"]/price')[0];
      price = 0;
      $('.btn-calc-platform.active', settings.types).each(function () {
        var $platform = $(this);
        var tmpPrice = tmpSearch[$platform.data('value')];
        price += tmpPrice;
      });

      $('.cf-price', '#cf-' + $feature.data('value') ).text('$'+price.format(2));
    });
  } else {   
    var $item = $('#cf-' + $feature.data('value'));

    if ($item.length) {
      $item.remove();
    }
    else if ($item.length == 0) {
      if ($feature.hasClass('active')) {
        var tmpSearch = {};

        if (feature_type == 'admin') {
          tmpSearch = JSON.search(settings.allItems, '//admin_features[id="'+$feature.data('value')+'"]/price')[0];
        } else {
          tmpSearch = JSON.search(settings.allItems, '//platform_features[id="'+$feature.data('value')+'"]/price')[0];
        }

        $('.btn-calc-platform.active', settings.types).each(function () {
          var $platform = $(this);
          var tmpPrice = tmpSearch[$platform.data('value')];
          
          price += tmpPrice;
        });

        if (feature_type == 'admin') {
          tmpSearch = JSON.search(settings.allItems, '//admin_features[id="'+$feature.data('value')+'"]/*');
        } else {
          tmpSearch = JSON.search(settings.allItems, '//platform_features[id="'+$feature.data('value')+'"]/*');
        }

        $list.append(
          '<div id="cf-'+tmpSearch[0]+'" class="col-xs-12 not-padding-side">'+
          '\t<div class="col-xs-9">'+
          '\t\t'+tmpSearch[2]+
          '\t</div>'+
          '\t<div class="col-xs-3 not-padding-side">'+
          '\t\t<b class="cf-price pull-right">$'+price.format(2)+'</b>'+
          '\t</div>'+
          '\t<div class="col-xs-12 bottom-margin"></div>'+
          '</div>'
        );
      }
    }
  }
  calcularTotal($container, $list, settings);
}

$.fn.calculator = function (options) {
  var $container = $(this);
  var defaults = {
    action: null,
    items: [],
    submenu: false,
    types: {},
    features: {},
    admin_features: {},
    allItems: null
  };

  var settings = $.extend({}, defaults, options);

  switch (settings.action) {
    case 'select_platform':
      var nextUrl = $body.data('origin') + '/calculator/features';
      var $form = $('#app-calc-form');
      var n = settings.items.length;
      var tmpObj = null;
      for (var i = 0; i < n; ++i) {
        tmpObj = settings.items[i];
        $form.append(
          '<input type="checkbox" class="not-visible" name="p[]" id="calc-option-'+tmpObj.id+'" value="'+tmpObj.id+'" />'
        );
        $container.append(
          '<div class="col-xs-6 col-sm-3 not-padding-side">'+
          '\t<div id="cp-'+tmpObj.id+'" class="col-xs-11 col-xs-offset-1 btn-calc-platform '+( settings.submenu ? "mini" : null )+' animated" data-value="'+tmpObj.id+'">'+
          '\t\t<h3 class="text-center">'+
          '\t\t\t<span class="icon-calculator fa fa-'+tmpObj.icon+'"></span>'+
          '\t\t\t'+tmpObj.text+
          '\t\t</h3>'+
          '\t</div>'+
          '</div>'
        );
      }
      $('.btn-calc-platform').each(function() {
        $(this).click(function() {
          var $element = $(this);
          if ($element.hasClass('active')) {
            $element.removeClass('bounceIn active').addClass('bounce');
            $('#calc-option-' + $element.data('value')).prop('checked', false);
            var arrPlatforms = JSON.parse(localStorage.getItem("calc_platforms"));
            var tmpIndex = arrPlatforms.indexOf($element.data('value'));
            tmpArrPlatforms = [];
            var j = 0;
            for (var i = 0; i < arrPlatforms.length; ++i) {
              if (i != tmpIndex) {
                tmpArrPlatforms[j++] = arrPlatforms[i];
              }
            }
            arrPlatforms = tmpArrPlatforms;
            localStorage.setItem("calc_platforms", JSON.stringify(arrPlatforms));
          } else {
            $element.addClass('bounceIn active');
            $('#calc-option-' + $element.data('value')).prop('checked', true);
            if (! localStorage.hasOwnProperty("calc_platforms")) {
              localStorage.setItem("calc_platforms", JSON.stringify([$element.data('value')]));
            } else {
              var arrPlatforms = JSON.parse(localStorage.getItem("calc_platforms"));
              arrPlatforms.push($element.data('value'));
              localStorage.setItem("calc_platforms", JSON.stringify(arrPlatforms));
            }
          }
        });
      });
      $('.btn-calc-submit').click(function(event) {
        event.preventDefault();
        $form.submit();
      });
    break;

    case 'select_features':
      var nextUrl = $body.data('origin') + '/calculator/features';
      var $form = $('#app-calc-form');
      var n = settings.items.length;
      for (var i = 0; i < n; ++i) {
        tmpObj = settings.items[i];
        $container.append(
          '<div class="col-xs-6 col-sm-4 col-md-3 not-padding-side">'+
          '\t<div class="col-xs-11 col-xs-offset-1 btn-calc-features animated" data-value="'+tmpObj.id+'" data-toggle="tooltip" title="'+tmpObj.description+'">'+
          '\t\t<h3 class="text-center">'+
          '\t\t\t<span class="icon-calculator fa fa-'+tmpObj.icon+'"></span>'+
          '\t\t\t'+tmpObj.text+
          '\t\t</h3>'+
          '\t</div>'+
          '</div>'
        );
        $form.append(
          '<input type="checkbox" class="not-visible" name="f[]" id="calc-option-'+tmpObj.id+'" value="'+tmpObj.id+'" />'
        );
      }
      $('.btn-calc-features').click(function() {
        var $element = $(this);
        if ($element.hasClass('active')) {
          $element.removeClass('bounceIn active').addClass('bounce');
          $('#calc-option-' + $element.data('value')).prop('checked', false); 
        } else {
          $element.addClass('bounceIn active');
          $('#calc-option-' + $element.data('value')).prop('checked', true);
          if ($(window).width() > 480) {
            $element.tooltip('show');
          }
        }
      });
    break;

    case 'select_admin_features':
      var $form = $('#app-calc-form');
      var n = settings.items.length;
      for (var i = 0; i < n; ++i) {
        tmpObj = settings.items[i];
        $container.append(
          '<div class="col-xs-6 col-sm-4 col-md-3 not-padding-side">'+
          '\t<div class="col-xs-11 col-xs-offset-1 btn-calc-admin-features animated" data-value="'+tmpObj.id+'" data-toggle="tooltip" title="'+tmpObj.description+'">'+
          '\t\t<h3 class="text-center">'+
          '\t\t\t<span class="icon-calculator fa fa-'+tmpObj.icon+'"></span>'+
          '\t\t\t'+tmpObj.text+
          '\t\t</h3>'+
          '\t</div>'+
          '</div>'
        );
        $form.append(
          '<input type="checkbox" class="not-visible" name="af[]" id="calc-option-'+tmpObj.id+'" value="'+tmpObj.id+'" />'
        );
      }
      $('.btn-calc-admin-features').click(function() {
        var $element = $(this);
        if ($element.hasClass('active')) {
          $element.removeClass('bounceIn active').addClass('bounce');
          $('#calc-option-' + $element.data('value')).prop('checked', false);
          if ($(window).width() > 480) {
            $element.tooltip('hide');
          }
        } else {
          $element.addClass('bounceIn active');
          $('#calc-option-' + $element.data('value')).prop('checked', true);
          if ($(window).width() > 480) {
            $element.tooltip('show');
          }
        }
      });
    break;

    case 'simulator':
      var $form = $('#app-calc-form');
      var arrPlatforms = JSON.parse(localStorage.getItem("calc_platforms"));
      for (var i = 0; i < arrPlatforms.length; ++i) {
        $('#cp-'+arrPlatforms[i]).addClass('bounceIn active');
        $('#calc-option-' + arrPlatforms[i]).prop('checked', true);
      }
      $('.btn-calc-features', settings.features).click(function (event) {
        var $element = $(this);
        var $list = $('.calc-list-features', $container);
        calculate($container, $list, settings, $element, 'single');
      });
      $('.btn-calc-admin-features', settings.admin_features).click(function (event) {
        var $element = $(this);
        var  $list = $('.calc-list-features', $container);
        calculate($container, $list, settings, $element, 'admin');
      });
      $('.btn-calc-platform', settings.types).click(function (event) {
        var $element = $(this);
        var $list = $('.calc-list-features', $container);
        calculate($container, $list, settings);
      });
      $('#app-calc-reset', $form).click(function(event) { 
        event.preventDefault();
        $('.btn-calc-features', settings.features).each(function() {
          var $element = $(this);
          $element.removeClass('bounceIn active').addClass('bounce');
          $('#calc-option-' + $element.data('value')).prop('checked', false);
        });
        $('.btn-calc-admin-features', settings.admin_features).each(function() {
          var $element = $(this);
          $element.removeClass('bounceIn active').addClass('bounce');
          $('#calc-option-' + $element.data('value')).prop('checked', false);
        });
        var $list = $('.calc-list-features', $container);
        var $total = $('.calc-total-cant', $container);
        $list.empty();
        $total.text('$0.00');
      });
    break;

    default:
    break;
  }
};
