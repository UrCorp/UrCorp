Number.prototype.toCurrency = function() {
  return this.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

$(function() {
  var $window = $(window),
      $body = $('body');

  $('a.anchorLink').anchorAnimate();

  $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please check your input."
  );
});
