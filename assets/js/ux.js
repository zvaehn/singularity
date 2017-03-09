var isMobileDevice = false;

$(document).ready(function() {

  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {

    isMobileDevice = true;
  }

  $(window).on('resize', function(el) {
    calculateGridWrapperSize(".img-wrapper");
    watchAffix();

    $(window).trigger("lookup");
    $grid.packery();
  });

  var $grid = $('.grid').packery({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });

  // improves layout in cost of performance
  /*var lastChecked = 0;

  $(window).on('scroll', function(e) {
    var now = Date.now();

    if(lastChecked + 1000 < now) {
      $grid.packery();
      lastChecked = now;
    }

    if($(window).scrollTop() + $(window).height() == $(document).height()) {
      $grid.packery();
    }
  });*/

  setTimeout(function() { $grid.packery(); }, 1000);
  setTimeout(function() { $grid.packery(); }, 2000);

  var unveilCounter = $(".unveil").length;
  var lastPercentage = 0;
  var processStack = 0;

  $(".unveil").unveil(200, function() {
    $(this).parents('.grid-item').addClass('-unveiled');

    $(window).trigger("lookup");

    $grid.packery();
  },
  {
    beforeUnveil: function(test) {
      processStack++;

      if(lastPercentage == 0) {
        $('.pace-progress').css('transform', 'translate3d(0%, 0px, 0px)');
      }

      var $spinner = $('.spinner');

      if(!$spinner.hasClass('-hidden')) {
        $spinner.addClass('-hidden');
      }
    },
    afterImageSetHasBeenLoaded: function() {
      // just to be sure
      $('.pace-progress').css('transform', 'translate3d(100%, 0px, 0px)');
    },
    imageSetProgressCallback: function(image, percent) {
      $(image).addClass('-unveiled');
      processStack--;

      $('.pace-progress').css('transform', 'translate3d('+percent+'%, 0px, 0px)');

      if(lastPercentage <= percent) {
        lastPercentage = percent;
        $('.pace-progress').css('transform', 'translate3d('+percent+'%, 0px, 0px)');

        if(lastPercentage >= 100) {
          lastPercentage = 0;
        }
      }
    }
  });

  inlineSVG();
  calculateGridWrapperSize(".img-wrapper");
  watchAffix();
  watchAffixMinSize();
  scrollTopButton(400);
  analytics();
});


function calculateGridWrapperSize(selector) {
  $(selector).each(function(index, el) {
    var height  = $(el).data('height');
    var width   = $(el).data('width');
    var currentWidth  = $(el).outerWidth();

    var cropFactor = (currentWidth / width) * 100;
    var croppedHeight = Math.round(height * cropFactor / 100);

    $(el).height(croppedHeight + "px");
  });
}

function watchAffix() {
  // Enable / Disable affix
  var windowHeight = $(window).height();
  var affixHeight   = $('.js-blog-affix').height();

  if(affixHeight > windowHeight) {
    $(window).off('.affix');
  }
  else {
    $(window).on('.affix');

    $('.js-blog-affix').affix({
      offset: {
        top: 305
      }
    });
  }
}

function watchAffixMinSize() {
  var contentHeight = $('.blogposts').height();
  var affixHeight   = $('.js-blog-affix').height();

  $('.blogposts').css('min-height', affixHeight + "px");
}

function scrollTopButton(offset) {
  offset = (offset) ? offset : 400;

	var back_to_top_button = ['<a href="#top" class="back-to-top"><span class="glyphicons glyphicon glyphicon-chevron-up"></span></a>'].join("");
	$("body").append(back_to_top_button);

	// Hide the button
	$(".back-to-top").hide();

	// Scrollspy
	$(function () {
    var lastVal = 0;
    var curVal = 0;
    var direction = 'down';

		$(window).scroll(function () {

      curVal = $(this).scrollTop();
      direction = (curVal > lastVal) ? 'down' : 'up';

      if(direction == 'down') {
        $('.back-to-top').fadeOut();
      }
      else {
  			if($(this).scrollTop() > offset) { // reached scroll offset
          if(direction == 'up') {
            $('.back-to-top').fadeIn();
          }
  			}
        else {
  				$('.back-to-top').fadeOut();
  			}
      }

      lastVal = curVal;
		});

		$('.back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
}

function inlineSVG() {
  $('img.svg').each(function(){
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function(data) {
      // Get the SVG tag, ignore the rest
      var $svg = jQuery(data).find('svg');

      // Add replaced image's ID to the new SVG
      if(typeof imgID !== 'undefined') {
        $svg = $svg.attr('id', imgID);
      }
      // Add replaced image's classes to the new SVG
      if(typeof imgClass !== 'undefined') {
        $svg = $svg.attr('class', imgClass+' replaced-svg');
      }

      // Remove any invalid XML tags as per http://validator.w3.org
      $svg = $svg.removeAttr('xmlns:a');

      // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
      if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
        $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
      }

      // Replace image with new SVG
      $img.replaceWith($svg);

    }, 'xml');
  });
}

function analytics() {
  if(!development) {
    $('.social-link-list a').on('click', function(event) {
      if(typeof ga === "function") {
        var destination = $(this).attr('href');

        ga('send', 'event', {
          eventCategory: 'Outbound Link',
          eventAction: 'click',
          eventLabel: destination,
          transport: 'beacon'
        });
      }
    });
  }
}
