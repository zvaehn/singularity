/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

;(function($) {

  $.fn.unveil = function(threshold, callback, options) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        options = options || {},
        queueCounter = 0,
        loaded;

    this.one("unveil", function() {
      if (typeof options.beforeUnveil === "function") options.beforeUnveil.call(this);

      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");

      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      var inviewImages = inview.length;

      for(var i = 0; i < inview.length; i++) {
        var j = i;

        // Add onload-event when not bined yet
        var imgEvents = window.jQuery._data(inview[i], "events");
        var valid = true;

        valid = valid && (typeof imgEvents !== "undefined");

        if(valid) {
          valid = valid && (typeof imgEvents.load === "undefined");
        }

        if(valid) {
          queueCounter++;

          window.jQuery(inview[i]).on('load', function() {
            queueCounter--;
            var loadPercentage = 100 - (queueCounter/inviewImages * 100);

            if(loadPercentage >= 0 && loadPercentage <= 100) {
              if (typeof options.imageSetProgressCallback === "function") options.imageSetProgressCallback.call(this, loadPercentage);
            }

            if(queueCounter == 0) {
              if (typeof options.afterImageSetHasBeenLoaded === "function") options.afterImageSetHasBeenLoaded.call(this);
            }
          });
        }
      }

      loaded = inview.trigger("unveil");
      images = images.not(loaded);

      /*console.log("inview: ", inviewImages);
      console.log("loaded: ", loaded.length);
      console.log("not loaded: ", images.length);*/
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;
  };

})(window.jQuery || window.Zepto);
