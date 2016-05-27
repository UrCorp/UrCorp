$(document).ready(function() {
  $body = $('body');
  var platform_types = [];
  var platform_features = [];
  var admin_features = [];

  $.ajax({
    dataType: "json",
    url: $body.data("origin") + "/public/assets/js/app/calculator.json",
    data: {},
    success: function (data) {
      platform_types = data["platform_types"];
      platform_features = data["platform_features"];
      admin_features = data["admin_features"];

      $('#app-platforms').calculator({
        action: 'select_platform',
        items: platform_types,
        submenu: true
      });
      var objPlatformsSelected = JSON.parse(localStorage.getItem("calc_platforms"));
      $('#app-features').calculator({
        action: 'select_features',
        items: platform_features
      });
      $('#admin-features').calculator({
        action: 'select_admin_features',
        items: admin_features
      });
      $('#app-calc-list').calculator({
        action: 'simulator',
        types: $('#app-platforms'),
        features: $('#app-features'),
        admin_features: $('#admin-features'),
        allItems: data
      });
      $('[data-toggle="tooltip"]').each(function() {
        $(this).data('placement', (($window.width() >= 748) ? 'right' : 'top'));
      });
      $('[data-toggle="tooltip"]').tooltip();
    },
    error: function (data) {
      alert("Error de conexión\nPor favor recargue la página web.");
    }
  });
});
