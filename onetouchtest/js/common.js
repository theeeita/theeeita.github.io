let yandexMap, $mapBlock = null, lastSelectedPoint = null;

let $tabsForm  = $(".order-content-wrapper .tabs-form"),
		$orderDataPanel = $(".order-data-panel"),
		$orderForm = $(".order-form"),
		$buttonsDeliveryType = $(".radio-buttons-wrapper input"),
		$deliveryPointBlock = $(".label-group.delivery-point"),
		$selectPointElement = $deliveryPointBlock.find("[name=\"delivery-point\"]"),
		$mapWrapper = $deliveryPointBlock.find(".yandex-map-wrapper");

correctLabelBorders( $(".order-content-wrapper label.selected") );

// Табы, которые переключают форму
$tabsForm.find(".tab-button-item").click(function() {
	let $clicked = $(this);
	$clicked.siblings().removeClass("active");
	$clicked.addClass("active");
	$tabsForm.find(".tab-content-item").hide().eq($clicked.index()).fadeIn();
}).eq(0).addClass("active");


// Валидация полей:
$orderForm.find("input[type=\"text\"]").add($(".subscribe-form input[name=\"email\"], textarea")).blur(function() {
	let $currentInput = $(this),
			value = $(this).val(),
			name = $currentInput.attr("name"),
			$errorElement = $("<span class=\"invalid-input\"></span>");

	if(value !== "") {
		// Текстовые поля:
		if(name === "name" || name === "surname") {
			if(value.match(/[а-яА-ЯёЁ\s-]/g)) {
				$currentInput.removeClass("invalid-value");
				$currentInput.next().remove();
				return;
			}
	
			if(!$currentInput.next().is(".invalid-input")) {
				$errorElement.text("Недопустимые символы. Это поле может содержать только русские буквы или дефис.");
				$currentInput.after($errorElement);
			}
			$currentInput.addClass("invalid-value");
		}

		// Поле электронной почты (форма заказа и в футере):
		if(name === "email") {
			if(value.match(/[a-zA-Z]/g)) {
				$currentInput.removeClass("invalid-value");
				$currentInput.next().remove();
				return;
			}

			if(!$currentInput.next().is(".invalid-input")) {
				$errorElement.text("Недопустимые символы. Это поле может содержать только латиницу.");
				if($currentInput.hasClass("footer-email")) $errorElement.css({"position": "absolute"});
				$currentInput.after($errorElement);
			}
			$currentInput.addClass("invalid-value");
		}

		// Запрет ввода HTML в textarea.
		if(name === "comment") {
			if(!value.match(/<[^<>]+>/g)) {
				$currentInput.removeClass("invalid-value");
				$currentInput.next().remove();
				return;
			}
			if(!$currentInput.next().is(".invalid-input")) {
				$errorElement.text("Недопустимые символы. Это поле не может содержать html.");
				$currentInput.after($errorElement);
			}
			$currentInput.addClass("invalid-value");
		}
	}
});

// Маска для телефона
$orderForm.find("[name=\"phone\"]").keydown(function(event) {
	let data  = event.key,
			value = $(this).val();

	if(data !== "Backspace") {
		if(!data.match(/\d/) || value.length >= 13) return false;
		if(value.length === 3 || value.length === 7 || value.length === 10) $(this).val(value+" ");
	}

});

// Обработка выбора способа доставки.
$buttonsDeliveryType.click(function() {
	let $clicked = $(this),
			$clickedLabel = $clicked.parents("label"),
			valuePrice = +$clicked.val(),
			type = $clicked.attr("data-type");

	if(type === "Самовывоз") {
		$deliveryPointBlock.addClass("active");
		let currentSelectedPoint = $selectPointElement.val(),
				pointInfo = $selectPointElement.find("option:selected").attr("data-point-info");
		if($mapBlock === null) {
			$mapBlock = $("<div class=\"yandex-map\" id=\"yandex-map\">");
			$mapBlock.append( $("<div class=\"point-info\">" + pointInfo +  "</div>") );
			$mapWrapper.append($mapBlock);
			ymaps.ready(init.bind(null, currentSelectedPoint));
		}
	} else {
		if($mapBlock) $mapBlock.remove();
		$mapBlock = null;
		$deliveryPointBlock.removeClass("active");
	}

	// Стилизация label, чтобы border не накладывались друг на друга при смене стилей.
	correctLabelBorders($clickedLabel);

	// Вывод данных в блоке "Ваш заказ" и корзине.
	outputOrderData(valuePrice, type);
});

// Изменения пункта самовывоза.
$selectPointElement.change(function() {
	let selectedPoint = $(this).val(),
			pointInfo = $(this).find("option:selected").attr("data-point-info");

	if(selectedPoint === lastSelectedPoint) return;

	$mapBlock.remove();
	$mapBlock = $("<div class=\"yandex-map\" id=\"yandex-map\"></div>");
	$mapBlock.append( $("<div class=\"point-info\">" + pointInfo + "</div>") );
	$mapWrapper.append($mapBlock);
	ymaps.ready(init.bind(null, selectedPoint));

	lastSelectedPoint = selectedPoint;
});

let maxFooterItemHeight = getMaxHeight($(".footer-menu-item"));
$(".footer-menu-item").each(function() {
	$(this).css({ "height": maxFooterItemHeight+"px" });
});



// Вспомогательные функции:

/**
 * @description Возвращает самую большую высоту из всех элементов в выборке.
 *
 * @param {Object} $elements JQuery выборка элементов.
 */
function getMaxHeight($elements) {
	let values = $elements.map(function() {
		return $(this).height();
	}).toArray();

	return Math.max(...values);
}

/**
 * @description Высчитывает и выводит данные о стоимости заказа.
 * 
 * @param {Number} value Стоимость доставки.
 * @param {String} type Тип доставки.
 */
function outputOrderData(value, type) {
	let goodsCount = $orderDataPanel.find(".order-goods-info .data-list-item").length,
			tempPrice  = $orderDataPanel
					.find(".order-goods-info .data-list-item").map(function() { return +$(this).find(".list-item-value").text().replace(/\D/g, "");})
					.toArray()
					.reduce(function(total, priceItem) {
						return total += priceItem;
					}, 0);

	let discount = (tempPrice <= 0) ? 0 : Math.floor(tempPrice * 0.05);
	tempPrice -= discount;
	let finalPrice = tempPrice + value;

	// Отображение в корзине.
	$(".basket-goods-count").text( goodsCount );
	$(".basket-price").text( formatPrice(finalPrice) );

	$orderDataPanel
		.find(".order-price-details .data-list-item.discount .list-item-value")
		.text( formatPrice(discount) );
	$orderDataPanel
	.find(".order-price-details .data-list-item.temp-price .list-item-value")
	.text( formatPrice(tempPrice) );

	$orderDataPanel
		.find(".order-price-details .data-list-item.delivery-type-data .list-item-prop")
		.text(type);
	$orderDataPanel
		.find(".order-price-details .data-list-item.delivery-type-data .list-item-value")
		.text( formatPrice(value) );

	$orderDataPanel
		.find(".order-data-item.final-price .list-item-value")
		.text( formatPrice(finalPrice) );
}

/**
 * @description Формирует цену, разбивая разряды числа по пробелам. В конец ставит знак рубля.
 * 
 * @param {Number} price Цена.
 */
function formatPrice(price) {
	return (isNaN(price)) ? 0 : String(price).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 ") + " ₽";
}

/**
 * @description Функция добавления яндекс карты на сайт с указанными координатами.
 * 
 * @param {Array} coords Координаты [ x, y ].
 */
function init(coords) {
		let arrayCoords = coords.split(" ").map(function(item) { return +item });

		yandexMap = new ymaps.Map("yandex-map", {
				center: arrayCoords,
				controls: [],
				zoom: 16
		});
		
		let placemark = new ymaps.Placemark(arrayCoords, {
			hintContent: "",
			balloonContent: "",
			}, {
				iconLayout: 'default#image',
				// Метка из макета
				iconImageHref: "../img/yandex_markPoint.png",
				iconImageOffset: [ -40, -60 ]
		});
		yandexMap.geoObjects.add(placemark);
}

/**
 * @description Поправляет свойство border, у элементов label.
 * 
 * @param {Object} $selectedLabel Выбранный label (Jquery объект).
 */
function correctLabelBorders($selectedLabel) {
	$selectedLabel.addClass("selected");
	$selectedLabel.siblings().each(function() {
		$(this).removeClass("selected");
		$(this).attr("style", "");
	});

	$selectedLabel.attr("style", "");
	$selectedLabel.next().attr("style", "border-top-color:transparent");
	$selectedLabel.prev().attr("style", "border-bottom-color:transparent");
}