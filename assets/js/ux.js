
function lazyload() {
  $(".js-lazyload").lazyload({
    threshold : 3000,
    effect: "fadeIn"
  });

  $(".js-lazyload").show().lazyload();
}


$(document).ready(function() {
  /*var $el = $('.js-infinity-wall');
  var listView = new infinity.ListView($el);*/

  /*$(document).on('error', 'img', function (el) {
    console.log(el + " has an error");
  });*/

  $(window).on('resize', function(el) {
    $(window).trigger("lookup");
    $grid.packery(); 
  });

  var $grid = $('.grid').packery({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    // percentPosition: true
  });

  $(".unveil").unveil(200, function() {
    // $(this).load(function() {
    this.style.opacity = 1;
    // });
    // Update the layout

    $(window).trigger("lookup");
    $grid.packery();
  });

  // lazyload();

  // make all grid-items draggable
  /*$grid.find('.grid-item').each( function( i, gridItem ) {
    var draggie = new Draggabilly( gridItem );
    // bind drag events to Packery
    $grid.packery( 'bindDraggabillyEvents', draggie );
  });*/

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
