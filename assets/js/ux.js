
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


  console.log(listView.top);
  console.log(listView.height);
  /*var $newContent = $('<p>Hello World</p>');
  listView.append($newContent);*/

  lazyload();
});
