jQuery.fn.anchorAnimate = function(settings) {
  settings = jQuery.extend({
    speed : 400
  }, settings); 
  
  return this.each(function(){
    var caller = this
    $(caller).click(function (event) {  
      event.preventDefault()
      var locationHref = window.location.href,
          elementClick = $(caller).attr("href"),
          destination = $(elementClick).offset().top,
          $header = $('#header');

      if ($header.length == 1) {
        var windowWidth = window.innerWidth;

        if (windowWidth >= 1024) {
          destination -= 70;
        }
        else if (windowWidth >= 1024) {
          destination -= 66;
        }
        else if (windowWidth >= 768) {
          destination -= 62;
        }
      }
      
      $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, settings.speed, function() {
        window.location.hash = elementClick
      });
        return false;
    })
  })
}