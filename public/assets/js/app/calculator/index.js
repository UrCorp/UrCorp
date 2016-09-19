function Calculator(items, platforms) {
  var __self = this;
  this.items = items || [];
  this.platforms = platforms || [];
  this.itemNames = {};
  this.prices = {};
  this.shoppingCart = {};

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

$(document).on('ready' , function() { 

  var $window = $(window),
      $body = $('body'),
      $webCalculator = $('#web-calculator'),
      $platformsContainer = $('#platforms-container'),
      $itemsContainer = $('#items-container'),
      $shoppingCart = $('#shoppingCart'),
      $total = $('#total'),
      objCalculator = null,
      items = [],
      platforms = [];

  $('.item.active').each(function() {
    var $this = $(this),
        id = $this.data('id');

    var $option = $('#items-selector option#item-'+id, $webCalculator);
    
    items.push(id);
    $option.prop('selected', true);
  });

  $('.platform.active').each(function() {
    var $this = $(this),
        id = $this.data('id');

    var $option = $('#platforms-selector option#platform-'+id, $webCalculator);

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
      $option = $('#items-selector option#item-'+id, $webCalculator);
      
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
      $('.amount', $total).html(total.toCurrency());
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
      $option = $('#platforms-selector option#platform-'+id, $webCalculator);

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
      $('.amount', $total).html(total.toCurrency());
    });

    $(document).unbind('ajaxComplete');
  });
});