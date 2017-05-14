$(document).ready(function(){

  var $body = $("html, body"),
      $news = $("#news"),
      $vid = $(".js-video");;

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

  $(".js-toggle-audio").on("click", function(e) {
    e.preventDefault();

    if($vid.prop("muted")) {
      $vid.prop("muted", false);
      $body.addClass("is-unmuted");
    }
    else {
      $vid.prop("muted", true);
      $body.removeClass("is-unmuted");
    }
  });

});
