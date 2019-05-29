;$(function() {

    // Слайдер в шапке (.main-header):
    var $headerSlider = $(".main-header .slider");
    var headerSliderOptions = {
        items: 1,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplaySpeed: 300,
        loop: false,
        nav: false,
        mouseDrag: false,
        itemClass: "slide-wrapper",
    };

    $headerSlider.owlCarousel(headerSliderOptions);

    $(".main-header .slide-next").on("click", function () {
        $headerSlider.trigger('next.owl.carousel')
    });

    $(".main-header .slide-prev").on("click", function () {
        $headerSlider.trigger('prev.owl.carousel');
    });

    // Слайдер в .main-content
    var $newsSlider = $(".main-content .news-slider");
    var newsSliderOptions = {
        items: 1,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplaySpeed: 300,
        loop: false,
        nav: false,
        mouseDrag: false,
        itemClass: "slide-wrapper",
    };

    $newsSlider.owlCarousel(newsSliderOptions);

    $(".news-slide-next").on("click", function () {
        $newsSlider.trigger('next.owl.carousel')
    });

    $(".news-slide-prev").on("click", function () {
       $newsSlider.trigger('prev.owl.carousel');
    });

});