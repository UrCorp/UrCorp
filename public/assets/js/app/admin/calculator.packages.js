$(function() {
  var $iconSelect = $('#icon-select'),
      $iconView   = $('#icon-view');

  $iconSelect.change(function(event) {
    var $span = $('span', $iconView);

    var iconClass = $span.attr('class').match(/fa-[a-zA-Z0-9\-]{1,}/);

    if (iconClass != null) {
      iconClass = iconClass[0];

      $span.removeClass(iconClass)
           .addClass('fa-'+$('option:selected', $iconSelect).text());
    }
  });
});