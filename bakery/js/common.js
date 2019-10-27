// Меню на мобильных устройствах:
var $mobileMenuButton = $(".mobile-menu-toggle");
var $mainMenu = $(".main-menu");
$mobileMenuButton.on("click", function () {
  $mainMenu.slideToggle().toggleClass("active");
});

// Слайдер + табы
var $sliderTabs = $(".section-slider .tabs-wrapper");
var $sliderTabsButtons = $sliderTabs.find(".tab-button");
var $sliderTabsContents = $sliderTabs.find(".tab-content-item");

$sliderTabs.find(".tab-button:first-child").addClass("active");
$sliderTabsContents .not(":first").hide();
$sliderTabsButtons.on("click", function () {
  var currentIndex = $(this).index();
  $sliderTabsButtons.removeClass("active").eq(currentIndex).addClass("active");
  $sliderTabsContents.hide().eq(currentIndex).fadeIn();
});

var $sliderControlPrev = $sliderTabs.find(".slide-prev");
var $sliderControlNext = $sliderTabs.find(".slide-next");

var offset = parseInt($sliderTabsButtons.css("width"))
           + parseInt($sliderTabsButtons.css("margin-left"))
           + parseInt($sliderTabsButtons.css("margin-right"));

var positionLeft = 0;
var maxOffset = parseInt($sliderTabsButtons.css("width")) * $sliderTabs.find(".tab-button").length - offset*2;

$sliderControlPrev.on("click", function () {
  if(parseInt($sliderTabs.find(".tabs-buttons").css("left")) >= 0) return;
  positionLeft += offset;
  $sliderTabs.find(".tabs-buttons").css("left", positionLeft+"px");
});

$sliderControlNext.on("click", function () {
  if( parseInt($sliderTabs.find(".tabs-buttons").css("left")) <= -maxOffset) return;
  positionLeft -= offset;
  $sliderTabs.find(".tabs-buttons").css("left", positionLeft+"px");
});

// Карточки
/**
 * @description Сортирует коллекцию Jquery со сдвигом вправо.
 * @param {Object} $collection - коллекция jquery, которую необходимо отсортировать.
 * @param {Object} right - параметры сдвига вправо, start - изначальная позиция, offset - сдвиг.
 * @param {Number} zIndex - z-index самого первого элемента.
 * @param {Object} scale - параметры масштабирования, start - изначальный масштаб, scaling - коэффициент мастабирования.
 * @param {Number} minWidth - минимальная ширина окна, при которой должна работать функция.
 */
function shuffleRight($collection, right, zIndex, scale, minWidth) {
  if( ($(window).width() <= minWidth) ) return;
  $collection.each(function () {
    var $current = $(this);
    $current.css({
      "right": right.start+"px",
      "z-index": zIndex,
      "transform": "scaleY("+scale.start+")"
    });
    right.start -= right.offset;
    zIndex -= 1;
    scale.start -= scale.scaling;
  });
}

var $priceCards = $(".section-price-list .price-card");

shuffleRight($priceCards, { start: 0, offset: 15 }, $priceCards.length, { start: 1, scaling: 0.05 }, 992);
$priceCards.first().addClass("active-card");

$priceCards.on("click", function () {
  var $clicked = $(this);
  if( parseInt($clicked.css("right")) === 0 ) return;
  $clicked.css({
    "right": 0+"px",
    "z-index": $priceCards.length,
    "transform": "scaleY("+1+")"
  }).addClass("active-card");
  var $clickedSiblings = $clicked.siblings();
  $clickedSiblings.removeClass("active-card");
  shuffleRight($clickedSiblings, { start: -15, offset: 15 }, $clickedSiblings.length, { start: 0.95, scaling: 0.05 }, 992);
});