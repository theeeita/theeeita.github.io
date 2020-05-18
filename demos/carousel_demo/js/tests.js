"use strict";

const test1 = new Carousel({ root: document.querySelector(".test-1"), }),
			test1Pause = document.querySelector(".test-1_pause"),
			test1Play  = document.querySelector(".test-1_play");

test1Pause.addEventListener("click", test1.pause.bind(test1));
test1Play.addEventListener("click", test1.play.bind(test1));

const test2 = new Carousel({
	root: document.querySelector(".test-2"),
	outerClass: "test-2-wrapper",
	autoplay: false,
	
	navClass: "test-2-nav",
	dotsClass: "test-2-dots",
	dotItemClass: "test-2_dot-item",
	buttonsClass: "test-2-buttons",

	prevButtonHTML: "<i>Назад</i>",
	nextButtonHTML: "<i>Вперед</i>",
	prevButtonClass: "test-2-prev",
	nextButtonClass: "test-2-next",
});

const test3 = new Carousel({
	root: document.querySelector(".test-3"),
	nav: false,
	autoplay: false,
	draggable: true,
	}),
	test3Prev = document.querySelector(".test-3_prev"),
	test3Next = document.querySelector(".test-3_next");

test3Prev.addEventListener("click", test3.prev.bind(test3));
test3Next.addEventListener("click", test3.next.bind(test3));
