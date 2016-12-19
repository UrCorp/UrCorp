$.fn.calculator = function() {
  return new Calculator(this);
}

function Calculator($element) {
  this.items = [],
  this.platforms = [],
  this.itemNames = {},
  this.prices = {},
  this.shoppingCart = {},
  this.subtotal = 0.00,
  this.applyDiscount = false,
  this.discount = { 
    percentage: 0.00, 
    amount: 0.00 
  },
  this.total = 0.00,
  this.$body = $('body'),
  this.$appModal = $('#app-modal'),
  this.$calculatorForm = $('.calculator-form', $element),
  this.$selectItems = $('.calculator-select-items', this.$calculatorForm),
  this.$selectPlatforms = $('.calculator-select-platforms', this.$calculatorForm),
  this.$platformsContainer = $('.platforms-container', $element),
  this.$itemsContainer = $('.items-container', $element),
  this.$shoppingCart = $('.calculator-shoppingcart', $element),
  this.$priceContainer = $('.calculator-price-container', $element),
  this.$promotionForm = $('.calculator-form-promotion', $element),
  this.$inputAppliedPromotionCode = $('.calculator-input-applied-promotion-code', $element),
  this.$inputPromotionCode = $('.calculator-input-promotion-code', $element),
  this.$subtotalContainer = $('.calculator-subtotal-container', this.$priceContainer),
  this.$sendByEmailForm = $('.calculator-form-email-send', $element);

  return this.__construct($element);
}

Calculator.prototype.__construct = function($element) {
  var __self = this;

  $('.item.active', $element).each(function() {
    var $this = $(this),
        id = $this.data('id'),
        $option = $('option#item-' + id, __self.$selectItems);
    
    __self.items.push(id);
    $option.prop('selected', true);
  });

  $('.platform.active', $element).each(function() {
    var $this = $(this),
        id = $this.data('id'),
        $option = $('option#platform-' + id, __self.$selectPlatforms);
    
    __self.platforms.push(id);
    $option.prop('selected', true);
  });

  $.ajax({
    type: 'GET',
    url: 'api/v1/calculator/web/prices',
    dataType: 'json',
    beforeSend: function() {},
    success: function(resp) {
      if (resp.status == 'SUCCESS') {
        __self.init(resp.data.itemNames, resp.data.prices);

        $('.platform', __self.$platformsContainer).click(__self.platformClickEvent());
        $('.item', __self.$itemsContainer).click(__self.itemClickEvent());
        __self.$promotionForm.submit(__self.applyPromotionEvent());
        __self.sendByEmailEvent();
      }
    },
    error: function(res, textStatus, jqxhr) {
      alert("AJAX Error");
    }
  });
}

Calculator.prototype.init = function(itemNames, prices) {
  this.itemNames = typeof(itemNames) == "object" ? itemNames : {};
  this.prices = typeof(prices) == "object" ? prices : {};
  this.calculate();
}

Calculator.prototype.calculate = function() {
  this.subtotal = this.total = 0;
  this.shoppingCart = {};

  for (var i = 0; i < this.items.length; ++i) {
    var item = this.items[i];
    this.shoppingCart[item] = 0.00;

    for (var j = 0; j < this.platforms.length; ++j) {
      var platform = this.platforms[j];
      this.shoppingCart[item] += this.prices[item][platform];
      this.subtotal += this.prices[item][platform];
    }
  }

  this.total = this.subtotal;

  if (this.applyDiscount) {
    this.discount.amount = (this.total * this.discount.percentage) / 100;
    this.total -= this.discount.amount;
  }
}

Calculator.prototype.addItem = function(id) {
  this.items.push(id);
  this.calculate();
  return this;
}

Calculator.prototype.removeItem = function(id) {
  var index = this.items.indexOf(id);
  this.items.splice(index, 1);
  this.calculate();
  return this;
}

Calculator.prototype.addPlatform = function(id) {
  this.platforms.push(id);
  this.calculate();
  return this;
}

Calculator.prototype.removePlatform = function(id) {
  var index = this.platforms.indexOf(id);
  this.platforms.splice(index, 1);
  this.calculate();
  return this;
}

Calculator.prototype.applyPromotionCode = function(promotionCode) {
  this.$inputAppliedPromotionCode.val(promotionCode);
  this.$inputPromotionCode.val('');
  return this;
}

Calculator.prototype.removePromotionCode = function() {
  this.$inputAppliedPromotionCode.val('');
  return this;
}

Calculator.prototype.addDiscount = function(percentage) {
  this.applyDiscount = true;
  this.discount.percentage = percentage;
  this.calculate();
  return this;
}

Calculator.prototype.removeDiscount = function() {
  this.applyDiscount = false;
  this.discount.percentage = 0.00;
  this.discount.amount = 0.00;
  this.calculate();
  return this;
}

Calculator.prototype.getShoppingCart = function() {
  return this.shoppingCart;
}

Calculator.prototype.getItemName = function(id) {
  return this.itemNames[id];
}

Calculator.prototype.getItemValue = function(id) {
  return this.shoppingCart[id];
}

Calculator.prototype.showPrice = function() {
  var __self= this,
      price = 0.00;

  __self.$shoppingCart.empty();
  shoppingCart = __self.getShoppingCart();

  for (var item in shoppingCart) {
    price = __self.getItemValue(item);

    __self.$shoppingCart.append(
      '<div class="item col-xs-12 no-side-padding" data-id="'+item+'">'+
      '\t<div class="col-xs-8 no-side-padding">'+
      '\t\t<p class="name">'+__self.getItemName(item)+'</p>'+
      '\t</div>'+
      '\t<div class="col-xs-4 no-side-padding">'+
      '\t\t<p class="pull-right price">'+price.toCurrency()+'</p>'+
      '\t</div>'+
      '</div>'
    );
  }

  if (__self.applyDiscount) {
    if ($('.calculator-discount-container', __self.$priceContainer).length == 0) {
      var $discountContainer = $(
        '<div class="calculator-discount-container col-xs-12 no-side-padding">'+
        '\t<div class="col-xs-6 no-side-padding">'+
        '\t\t<h5 class="lbl">Descuento <small class="calculator-discount-rate">('+__self.discount.percentage+'%)</small></h5>'+
        '\t</div>'+
        '\t<div class="col-xs-6 no-side-padding">'+
        '\t\t<button type="button" class="calculator-discount-remove pull-right"><span class="fa fa-times"></span></button>'+
        '\t\t<h5 class="calculator-discount-amount pull-right">'+__self.discount.amount.toCurrency()+'</h5>'+
        '\t</div>'+
        '</div>'
      );

      __self.$subtotalContainer.after($discountContainer);
      $('.calculator-discount-remove', $discountContainer).click(__self.removeDiscountEvent());
    } else {
      $('.calculator-discount-rate', __self.$discountContainer).html('('+__self.discount.percentage+'%)');
      $('.calculator-discount-amount', __self.$discountContainer).html(__self.discount.amount.toCurrency());
    }
  } else {
    $('.calculator-discount-container', __self.$priceContainer).remove();
  }

  $('.subtotal', __self.$priceContainer).html(__self.subtotal.toCurrency());
  $('.total', __self.$priceContainer).html(__self.total.toCurrency());
}

Calculator.prototype.platformClickEvent = function() {
  var __self = this;

  return function(event) {
    event.preventDefault();

    var $this = $(this),
        id = $this.data('id'),
        $option = null,
        price = 0.00;

    $this.toggleClass('bounce bounceIn active');
    $option = $('option#platform-'+id, __self.$selectPlatforms);

    if ($option.is(':selected')) {
      __self.removePlatform(id);
      $option.prop('selected', false);
    } else {
      __self.addPlatform(id);
      $option.prop('selected', true);
    }

    __self.showPrice();
  }
}

Calculator.prototype.itemClickEvent = function() {
  var __self = this;

  return function(event) {
    event.preventDefault();

    var $this = $(this),
        id = $this.data('id'),
        $option = null,
        price = 0.00;

    $this.toggleClass('bounce bounceIn active');
    $option = $('option#item-' + id, __self.$selectItems);

    if ($option.is(':selected')) {
      __self.removeItem(id);
      $option.prop('selected', false);
    } else {
      __self.addItem(id);
      $option.prop('selected', true);
    }

    __self.showPrice();
  }
}

Calculator.prototype.applyPromotionEvent = function() {
  var __self = this;

  return function(event) {
    event.preventDefault();
    var promotionCode = __self.$inputPromotionCode.val();

    $.ajax({
      type: 'GET',
      url: 'api/v1/promotion/discount/' + promotionCode,
      dataType: 'json',
      beforeSend: function() {
        __self.$body.loading({
          message: "Cargando promoción...",
          theme: 'light',
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
          __self.applyPromotionCode(promotionCode).addDiscount(res.discount).showPrice();
        }

        __self.$body
          .loading('toggle')
          .loading({
            theme: 'light',
            message: res.msg,
            onStart: function(loading) {
              loading.overlay.slideDown(400);
            },
            onStop: function(loading) {
              loading.overlay.slideUp(400);
            }
          });
        setTimeout(function() { 
          __self.$body.loading('stop'); 
        }, 2800);
      },
      error: function(res, textStatus, jqxhr) {
        __self.$body
          .loading('toggle')
          .loading({
            message: 'Existe un error en la conexión <br/>¡Por favor, intente más tarde!',
            theme: 'light',
            onStart: function(loading) {
              loading.overlay.slideDown(400);
            },
            onStop: function(loading) {
              loading.overlay.slideUp(400);
            }
          });
        setTimeout( function ( ) { 
          __self.$body.loading('stop'); 
        }, 3200);
      }
    });
  }
}

Calculator.prototype.removeDiscountEvent = function() {
  var __self = this;

  return function(event) {
    event.preventDefault();
    __self.removePromotionCode().removeDiscount().showPrice();
  }
}

Calculator.prototype.getSerializedQuote = function() {
  var serial = this.$sendByEmailForm.serialize() +
               '&' + this.$calculatorForm.serialize() +
               '&' + this.$promotionForm.serialize();

  for (var key in arguments) {
    serial += '&' + arguments[key];
  }

  return serial;
}

Calculator.prototype.showModal = function(options) {
  var i,
      __self = this,
      settings = {
        header: null,
        title: null,
        body: null,
        footer: null
      };

  $.extend(settings, options);

  if (settings.header === null) {

    $('.modal-header', __self.$appModal).append(
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
      '\t<span aria-hidden="true">&times;</span>'+
      '</button>'+
      '<h4 class="modal-title">None</h4>'
    );
  } else {
    if (!$.isArray(settings.header)) {
      settings.header = [settings.header];
    }

    for (i = 0; i < settings.header.length; ++i) {
      $('.modal-header', __self.$appModal).append(settings.header[i]);
    }
  }

  if (settings.title !== null) {
    $('.modal-title', __self.$appModal).html(settings.title);
  }

  if (settings.body !== null) {
    if (!$.isArray(settings.body)) {
      settings.body = [settings.body];
    }

    for (i = 0; i < settings.body.length; ++i) {
      $('.modal-body', __self.$appModal).append(settings.body[i]);
    }
  }

  if (settings.footer === null) {
    $('.modal-footer', __self.$appModal).append(
      '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'
    );
  } else {
    if (!$.isArray(settings.footer)) {
      settings.footer = [settings.footer];
    }
    
    for (i = 0; i < settings.footer.length; ++i) {
      $('.modal-footer', __self.$appModal).append(settings.footer[i]);
    }
  }

  __self.$appModal.modal('show');
}

Calculator.prototype.showCommentsForm = function() {
  var __self = this,
      $modalBody = $(
        '<div class="container-fluid">'+
        '\t<div class="col-xs-12 no-side-padding">'+
        '\t\t<h4> Dejar un comentario <small>(opcional)</small>:</h4>'+
        '\t</div>'+
        '\t<div class="col-xs-12 no-side-padding">'+
        '\t\t<form class="calculator-form-extras">'+
        '\t\t\t<textarea name="quote[comment]" class="calculator-input-comments form-control" rows="7" autofocus></textarea>'+
        '\t\t</form>'+
        '\t</div>'+
        '</div>'
      ),
      $btnSkipAndSend = $(
        '<button type="button" class="calculator-quote-skip-and-send btn btn-primary">Omitir</button>'
      ),
      $btnSend = $(
        '<button type="button" class="calculator-quote-send btn btn-primary">Enviar</button>'
      );

  __self.showModal({
    title: 'Enviar cotización',
    body: $modalBody,
    footer: [
      '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>',
      $btnSkipAndSend,
      $btnSend
    ]
  });

  setTimeout(function() {
    $('.calculator-input-comments', $modalBody).focus();
  }, 520);
  
  $btnSend.click(function(event) {
    event.preventDefault();
    var serializedCommentsForm = $('.calculator-form-extras', $modalBody).serialize();

    __self.$appModal.modal('hide');

    $.ajax({
      type: "POST",
      url: __self.$sendByEmailForm.attr('action'),
      data:  __self.getSerializedQuote(),
      dataType : 'json',
      beforeSend: function() {
        __self.$body.loading({
          message: "Enviando...",
          theme: 'light',
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
          __self.$body.loading('stop');

          __self.showModal({
            title: 'Felicitaciones!',
            body: (
              '<div class="container-fluid">'+
              '\t<div class="col-xs-12 no-side-padding">'+
              '\t\t<div class="col-xs-12 no-side-padding">'+
              '\t\t\t<h4 class="text-center">¡La cotización ha sido enviada exitosamente!</h4>'+
              '\t\t</div>'+
              '\t\t<div class="col-xs-12 no-side-padding top-margin bottom-margin">'+
              '\t\t\t<div class="form-group">'+
              '\t\t\t\t<label class="col-xs-3 h4">Enlance <small><span class="fa fa-link"></span></small></label>'+
              '\t\t\t\t<div class="col-xs-9 no-side-padding">'+
              '\t\t\t\t\t<input name="quote[link]" class="form-control" placeholder="http://www.example.com/">'+
              '\t\t\t\t</div>'+
              '\t\t\t</div>'+
              '\t\t</div>'+
              '\t\t<div class="col-xs-12 top-margin bottom-margin">'+
              '\t\t\t<div class="divider"></div>'+
              '\t\t</div>'+
              '\t\t<div class="col-xs-12 no-side-padding">'+
              '\t\t\t<h5 class="text-center">También puede compartir en las siguientes redes sociales: </h5>'+
              '\t\t</div>'+
              '\t\t<div class="col-xs-12 no-side-padding bottom-margin text-center">'+
              '\t\t\t<div class="inline-block">'+
              '\t\t\t\t<span class="fa fa-facebook-square share share-with-facebook"></span>'+
              '\t\t\t</div>'+
              '\t\t\t<div class="inline-block">'+
              '\t\t\t\t<span class="fa fa-twitter-square share share-with-twitter"></span>'+
              '\t\t\t</div>'+
              '\t\t\t<div class="inline-block">'+
              '\t\t\t\t<span class="fa fa-google-plus-square share share-with-google-plus"></span>'+
              '\t\t\t</div>'+
              '\t\t</div>'+
              '\t</div>'+
              '</div>'
            )
          });
        }
      },
      error: function(res, textstatus, jqxhr) {
        alert("AJAX Error");
      }
    });
  });
}

Calculator.prototype.sendByEmailEvent = function() {
  var __self = this;

  __self.$sendByEmailForm.validate({
    rules: {
      'quote[email]': {
        required: true,
        email: true,
        maxlength: 250
      }
    },
    messages: {
      'quote[email]': {
        required: "Por favor, introduzca su correo electrónico.",
        email: "Correo electrónico inválido.",
      }
    },
    submitHandler : function(form) {
      __self.showCommentsForm();
      return false;
    }
  });
}

$(document).on('ready', function() { 
  $('#calculator').calculator();
});