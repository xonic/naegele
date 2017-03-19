$(document).ready(function(){

  var $body = $("html, body"),
      $news = $("#news");

  $('#js-slides').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    touchMove: true,
    prevArrow: '<div class="slick-prev"></div>',
    nextArrow: '<div class="slick-next"></div>',
  });

  $("#js-scroll").on("click", function(e) {
    console.log("hoi");
    e.preventDefault();

    $body.animate({
      scrollTop: $news.offset().top
    }, 300);
  });

});
