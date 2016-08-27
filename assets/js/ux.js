
function lazyload() {
  $(".js-lazyload").lazyload({
    threshold : 300,
    effect: "fadeIn"
  });

  $(".js-lazyload").show().lazyload();
}


$(document).ready(function() {
  var $el = $('.js-infinity-wall');
  var listView = new infinity.ListView($el);

  $(document).on('error', 'img', function (el) {
    console.log(el + " has an error");
  });

  lazyload();

/*
  // define flickrs not found image
  var imgNotFound = "https://farm3.staticflickr.com/2882/12612535054_c6424a2c86_h.jpg";
  $('.js-lazyload').on('load', function (el) {
    console.log(this.src);

    if(this.src == imgNotFound) {
      console.log("not found");
      this.src = $(this).attr('data-fallback');
    }
  });*/

});
