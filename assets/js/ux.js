
$(document).ready(function() {
  if(window.location.hash) {
    $el = $(window.location.hash);
    if($el) {
      $.scrollTo($el, 300);
    }
  }

  $(window).on('resize', function(el) {
    $(window).trigger("lookup");
    $grid.packery();
  });

  var $grid = $('.grid').packery({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });

  // improves layout in cost of performance
  var lastChecked = 0;

  $(document).on('scroll', function(e) {
    var now = Date.now();

    if(lastChecked + 1000 < now) {
      $grid.packery();
      lastChecked = now;
    }
  });

  $(".unveil").unveil(200, function() {
    this.style.opacity = 1;

    $(window).trigger("lookup");
    $grid.packery();

    $(".js-fittext").fitText(1.2, { minFontSize: '12px', maxFontSize: '40px' });
  });

});
