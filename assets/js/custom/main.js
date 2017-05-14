$(document).ready(function(){

  var $body = $("html, body"),
      $news = $("#news"),
      $vid = $(".js-video");;

  function setCookie(name, value, days) {
      var expires;
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      }
      else {
          expires = "";
      }
      document.cookie = name + "=" + value + expires + "; path=/";
  }

  function getCookie(c_name) {
      if (document.cookie.length > 0) {
          c_start = document.cookie.indexOf(c_name + "=");
          if (c_start != -1) {
              c_start = c_start + c_name.length + 1;
              c_end = document.cookie.indexOf(";", c_start);
              if (c_end == -1) {
                  c_end = document.cookie.length;
              }
              return unescape(document.cookie.substring(c_start, c_end));
          }
      }
      return "";
  }

  if(getCookie("privacy") !== "accepted") {
    $body.addClass("no-cookie");
  }

  $('#js-accept-cookies').on('click', function(e) {
    e.preventDefault();
    setCookie("privacy", "accepted", 365);
    $body.removeClass("no-cookie");
  });

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
