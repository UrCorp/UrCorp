function Calculator(items, platforms) {
  var __self = this;
  this.items = items || [];
  this.platforms = platforms || [];
  this.itemNames = {};
  this.prices = {};
  this.shoppingCart = {};
  this.discount = 0.00;

  $.ajax({
    type: 'GET',
    url: 'api/v1/calculator/web/prices',
    dataType: 'json',
    beforeSend: function() {

    },
    success: function(resp) {
      if (resp.status == 'SUCCESS') {
        __self.itemNames = resp.data.itemNames;
        __self.prices = resp.data.prices;
        __self.calculate();
      }
    },
    error: function(res, textStatus, jqxhr) {
      alert("AJAX Error");
    }
  });  
}

Calculator.prototype.calculate = function() {
  this.shoppingCart = {};

  for (var i = 0; i < this.items.length; ++i) {
    var item = this.items[i];
    this.shoppingCart[item] = 0.00;

    for (var j = 0; j < this.platforms.length; ++j) {
      var platform = this.platforms[j];
      this.shoppingCart[item] += this.prices[item][platform];
    }
  }
}

Calculator.prototype.addItem = function(id) {
  this.items.push(id);
  this.calculate();
}

Calculator.prototype.removeItem = function(id) {
  var index = this.items.indexOf(id);
  this.items.splice(index, 1);
  this.calculate();
}

Calculator.prototype.addPlatform = function(id) {
  this.platforms.push(id);
  this.calculate();
}

Calculator.prototype.removePlatform = function(id) {
  var index = this.platforms.indexOf(id);
  this.platforms.splice(index, 1);
  this.calculate();
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

Calculator.prototype.setDiscount = function(percentage) {
  return this.discount = percentage;
}

$(document).on('ready' , function() { 

  var $window = $(window),
      $body = $('body'),
      $appModal = $('#app-modal'),
      $webCalculatorForm = $('#form-web-calculator'),
      $platformsContainer = $('#platforms-container'),
      $itemsContainer = $('#items-container'),
      $shoppingCart = $('#shoppingCart'),
      $btnApplyPromo = $('#btn-apply-promo'),
      $promotionCode = $('#promotion-code'),
      $total = $('#total'),
      $shareQuote = $('#share-quote'),
      $sendByEmailForm = $('#form-send-by-email'),
      objCalculator = null,
      items = [],
      platforms = [];

  $('.item.active').each(function() {
    var $this = $(this),
        id = $this.data('id');

    var $option = $('#items-selector option#item-'+id, $webCalculatorForm);
    
    items.push(id);
    $option.prop('selected', true);
  });

  $('.platform.active').each(function() {
    var $this = $(this),
        id = $this.data('id');

    var $option = $('#platforms-selector option#platform-'+id, $webCalculatorForm);

    platforms.push(id);
    $option.prop('selected', true);
  });

  objCalculator = new Calculator(items, platforms);

  $(document).on('ajaxComplete', function() {

    $('.item', $itemsContainer).click(function(event){
      event.preventDefault();
      var $this = $(this),
          id = $this.data('id'),
          $option = null,
          shoppingCart = {},
          price = 0.00,
          total = 0.00;

      $this.toggleClass('bounce bounceIn active');
      $option = $('#items-selector option#item-'+id, $webCalculatorForm);
      
      if ($option.is(':selected')) {
        objCalculator.removeItem(id);
        $option.prop('selected', false);
      } else {
        objCalculator.addItem(id);
        $option.prop('selected', true);
      }

      $shoppingCart.empty();
      shoppingCart = objCalculator.getShoppingCart();

      for (var item in shoppingCart) {
        price = objCalculator.getItemValue(item);

        $shoppingCart.append(
          '<div class="item col-xs-12 no-side-padding" data-id="'+item+'">'+
          '\t<div class="col-xs-8">'+
          '\t\t<p class="name">'+objCalculator.getItemName(item)+'</p>'+
          '\t</div>'+
          '\t<div class="col-xs-4">'+
          '\t\t<p class="pull-right price">'+price.toCurrency()+'</p>'+
          '\t</div>'+
          '</div>'
        );
        total += price;
      }
      $('.subtotal', $total).html(total.toCurrency());
    });

    $('.platform', $platformsContainer).click(function(event){
      event.preventDefault();
      var $this = $(this),
          id = $this.data('id'),
          $option = null,
          shoppingCart = {},
          price = 0.00,
          total = 0.00;

      $this.toggleClass('bounce bounceIn active');
      $option = $('#platforms-selector option#platform-'+id, $webCalculatorForm);

      if ($option.is(':selected')) {
        objCalculator.removePlatform(id);
        $option.prop('selected', false);
      } else {
        objCalculator.addPlatform(id);
        $option.prop('selected', true);
      }

      $shoppingCart.empty();
      shoppingCart = objCalculator.getShoppingCart();

      for (var item in shoppingCart) {
        price = objCalculator.getItemValue(item);

        $shoppingCart.append(
          '<div class="item col-xs-12 no-side-padding" data-id="'+item+'">'+
          '\t<div class="col-xs-8 no-side-padding">'+
          '\t\t<p class="name">'+objCalculator.getItemName(item)+'</p>'+
          '\t</div>'+
          '\t<div class="col-xs-4 no-side-padding">'+
          '\t\t<p class="pull-right price">'+price.toCurrency()+'</p>'+
          '\t</div>'+
          '</div>'
        );
        total += price;
      }
      $('.subtotal', $total).html(total.toCurrency());
    });

    $btnApplyPromo.click(function(event) {
      event.preventDefault();

        $.ajax({
          type: 'GET',
          url: 'api/v1/promotions/code/' + $promotionCode.val(),
          dataType: 'json',
          beforeSend: function() {
            // more code here...
          },
          success: function(resp) {
            if (resp.status == 'SUCCESS') {
              __self.itemNames = resp.data.itemNames;
              __self.prices = resp.data.prices;
              __self.calculate();
            }
          },
          error: function(res, textStatus, jqxhr) {
            alert("AJAX Error");
          }
        });
    });

    $sendByEmailForm.validate({
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
        var $form = $(form);
        $.ajax({
          type: "POST",
          url: $form.attr('action'),
          data: $sendByEmailForm.serialize()+'&'+$webCalculatorForm.serialize(),
          dataType : 'json',
          beforeSend: function() { 
          },
          success: function(res) {
            console.log(res);
          },
          error: function(res, textstatus, jqxhr) {
            alert("AJAX Error");
          }
        });
        return false;
      }
    });

    if ($.fn.isMobile) {
      $('[data-toggle="tooltip"]').tooltip('destroy');

      $('.item', $itemsContainer).mousedown(function(e) {
        var $this = $(this);
        clearTimeout(this.downTimer);
        this.downTimer = setTimeout(function() {
          $('.modal-header', $appModal).append(
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<h3>' + $this.data('name') + '</h3>'
          );

          $('.modal-body', $appModal).append(
            '<p>' + $this.data('original-title') + '</p>'
          );

          $('.modal-footer', $appModal).append(
            '<button type="button" class="btn btn-default" data-dismiss="modal" autofocus>Cerrar</button>'
          );
          $appModal.modal('show');
        }, 200);
      }).mouseup(function(e) {
        clearTimeout(this.downTimer);
      });
    } else {
      $('[data-toggle="tooltip"]').tooltip();
    }

    $(document).unbind('ajaxComplete');
  });
});