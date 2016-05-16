$(document).ready(function() {
  if (localStorage.hasOwnProperty("calc_platforms")) {
    localStorage["calc_platforms"] = "[]";
  }
  $body = $('body');
  var platform_types = [];

  $.ajax({
    dataType: "json",
    url: $body.data("origin") + "/public/assets/js/app/calculator.json",
    data: {},
    success: function (data) {
      platform_types = data["platform_types"];
      $('#app-platforms').calculator({
        action: 'select_platform',
        items: platform_types
      });
    },
    error: function (data) {
      alert("Error de conexión\nPor favor recargue la página web.");
    }
  });
});