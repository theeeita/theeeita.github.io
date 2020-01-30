"use strict";

/**
 * Возвращает самую большую внешнюю ширину Jquery коллекции.
 *
 * @param {Object} $collection Коллекция из Jquery объектов.
 *
 * @returns {number} Ширина самого широкого элемента.
 */
let getMaxWidth = ($collection) => {
	let widths = [];
	$collection.each(function () {
		widths.push($(this).outerWidth());
	});

	return Math.max(...widths);
};

/**
 * Оборачивает первое слово элемента в span с указанным классом.
 * @param {Object} $element Исходный элемент.
 * @param {String} className Имя класса, которое должно быть у span-обёртки.
 */
let highlightFirstWord = ($element, className) => {
	let firstWord = $element.text().split(" ")[0];
	let rest = $element.html().slice($element.html().indexOf(" "));

	$element.html(`<span class="${className}">${firstWord}</span>${rest}`);
};


highlightFirstWord($("header .main-slogan"), "word-highlighter");
highlightFirstWord($("footer .main-slogan"), "word-highlighter");

let $addresItems = $(".address-item");
let maxWidth = getMaxWidth($addresItems);

$addresItems.each(function () {
	$(this).css({ "width": `${maxWidth}px` });
});