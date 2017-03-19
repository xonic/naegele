
var slides = document.querySelector('#slides'),
    i = 0,
    count = slides.querySelectorAll('li').length;

    console.log(count);

function slideNext() {
  TweenMax.to(slides, .5
    , { css: { "-webkit-transform": "translateX(-" + i++%count * 100 + "%)" } } );
}

// var autoSlide = setInterval(slideNext, 5000);
