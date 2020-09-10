"use strict";

// Слайдер в верхней части сайта
const $mainSlider = $(".slider--main-slider .slider__wrapper"),
      $mainSliderNext = $(".slider--main-slider .slider__next"),
      $mainSliderPrev = $(".slider--main-slider .slider__prev");

       $mainSlider.owlCarousel({
           mouseDrag: true,
           autoplay: false,
           items: 1,
           loop: true,
           margin: 0,
           itemClass: "slider__slide-wrapper",
           nav: false,
           dots: false,
       });

       $mainSliderPrev.on("click", () => {
           $mainSlider.trigger("prev.owl.carousel", [ 700 ]);
       });

       $mainSliderNext.on("click", () => {
           $mainSlider.trigger("next.owl.carousel", [ 700 ]);
       });

       $mainSlider.trigger("refresh.owl.carousel"); // исправление бага gap-scroll

// Слайдер с отзывами:
const $reviewsSlider = $(".slider--reviews_slider .slider__wrapper"),
      $reviewsSliderNext = $(".slider--reviews_slider .slider__next"),
      $reviewsSliderPrev = $(".slider--reviews_slider .slider__prev");

      $reviewsSlider.owlCarousel({
          mouseDrag: false,
          autoplay: false,
          loop: true,
          margin: 25,
          itemClass: "slider__slide-wrapper",
          nav: false,
          dots: false,
          responsive: {
              0: {
                  items: 1
              },
              1200: {
                  items: 2
              }
          }
      });

      $reviewsSliderNext.on("click", () => {
          $reviewsSlider.trigger("next.owl.carousel", [ 700 ]);
      });

        $reviewsSliderPrev.on("click", () => {
            $reviewsSlider.trigger("prev.owl.carousel", [ 700 ]);
       });

      $reviewsSlider.trigger("refresh.owl.carousel"); // исправление бага gap-scroll

// Слайдер клиентов:
const $clientsSlider = $(".slider--clients-slider .slider__wrapper"),
      $clientsSliderNext = $(".slider--clients-slider .slider__next"),
      $clientsSliderPrev = $(".slider--clients-slider .slider__prev");

      $clientsSlider.owlCarousel({
          mouseDrag: false,
          autoplay: false,
          items: 6,
          loop: true,
          margin: 15,
          itemClass: "slider__slide-wrapper",
          nav: false,
          dots: false,
          responsive: {
              1200: {
                  items: 6,
              },
              992: {
                  items: 4,
              },
              767: {
                  items: 3,
              },
              576: {
                  items: 2,
              },
              0: {
                  items: 1,
              }
          }
      });

      $clientsSliderNext.on("click", () => {
          $clientsSlider.trigger("next.owl.carousel", [ 700 ]);
      });

      $clientsSliderPrev.on("click", () => {
          $clientsSlider.trigger("prev.owl.carousel", [ 700 ]);
      });

    $clientsSlider.trigger("refresh.owl.carousel"); // исправление бага gap-scroll


// pop-up окно "subscribe"
const $popupSubscribeOpenButton  = $(`[data-action="popup-form"]`),
      $popupSubscribeContainer   = $(".popup-overlay"),
      $popupSubscribeCloseButton = $(".subscribe__close");

    $popupSubscribeOpenButton.on("click", () => {
        $popupSubscribeContainer.addClass("active");
        $("body").css({ "overflow": "hidden" });
    });
    $popupSubscribeCloseButton.on("click", () => {
        $popupSubscribeContainer.removeClass("active");
        $("body").css({ "overflow": "visible" });
    });


// Переменные для работы с Яднекс картой контактов:
let contactsMap, contactsPlaceMarker;

/**
 * @description Добавляет Яндекс-карту контактов по указанным координатам.
 * @param {String} address Строка адреса. Части резделять запятыми: "Россия, Москва, ...".
 * @param {String} container id элемента, в который будет подгружаться карта. Указывать без "#".
 * @param {String} pointerSrc Путь к иконке в центре макета
 */
function initContactsMap(address, container, pointerSrc) {

    // Поиск координат центра Нижнего Новгорода.
    ymaps.geocode(address, {
        results: 1
    }).then(function (res) {
        // Выбираем первый результат геокодирования.
        const geoObject = res.geoObjects.get(0),
              coords = geoObject.geometry.getCoordinates();

        contactsMap = new ymaps.Map(container, {
            center: coords,
            zoom: 15
        });

        contactsMap.controls.add(new ymaps.control.ZoomControl());

        contactsPlaceMarker = new ymaps.Placemark(coords, {
            iconLayout: "default#image",
            iconImageHref: pointerSrc,
            iconImageSize: [122, 59],
            iconImageOffset: [-3, -42]
        });

        contactsMap.geoObjects.add(contactsPlaceMarker);
    });
}