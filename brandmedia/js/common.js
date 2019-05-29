$(function() {

    // Меню на мобильных
    $(".main-menu li").has(".sub-menu").addClass("li-parent");

    $("li.li-parent").on("click", function () {
       $(this).find(".sub-menu").toggleClass("active");
    });

    // Табы
    $(".main-content .tab").click(function() {
        $(".main-content .tab").removeClass("active").eq($(this).index()).addClass("active");
        $(".tab-item").hide().eq($(this).index()).fadeIn()}).eq(0).addClass("active");

    // Слайдер
    var $slider = $(".slider");
    var sliderOptions = {
        items: 1,
        autoplay: true,
        autoplayTimeout: 2000,
        loop: true,
        nav: false,
        mouseDrag: false,
        itemClass: "slide-wrap",
        dotsClass: "slider-dots",
        dotClass: "dot-item"
    };

    // Запуск слайдера
    $slider.owlCarousel(sliderOptions);



    var $sliderNav = $(".slider-nav");
    var $slidePrev = $(".slide-prev");
    var $slideNext = $(".slide-next");
    var $slidePlayStop = $(".slide-play-stop");

    $(".slide-wrap").on("click", function () {
       $sliderNav.toggleClass("active");
    });

    $slideNext.on("click", function () {
        $slider.trigger('next.owl.carousel')
    });

    $slidePrev.on("click", function () {
        $slider.trigger('prev.owl.carousel');
    });

    $slidePlayStop.on("click", function () {
        var $self = $(this);
        if(!$slider.hasClass("paused")) {
            $slider.addClass("paused");
            $slider.trigger("stop.owl.autoplay");
            $self.find("i").removeClass().addClass("fa fa-play").attr("title", "Play");
        } else {
            $slider.removeClass("paused");
            $slider.trigger("play.owl.autoplay");
            $self.find("i").removeClass().addClass("fa fa-pause").attr("title", "Pause");
        }


    });

});