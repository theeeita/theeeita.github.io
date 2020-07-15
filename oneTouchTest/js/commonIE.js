	// Чтобы корректно работало в IE 10.
	
	var yandexMap = null;
	var $mapBlock = null;
	var lastSelectedPoint = null;

	var $tabsForm  = $(".order-content-wrapper .tabs-form");
	var $orderDataPanel = $(".order-data-panel");
	var $orderForm = $(".order-form");
	var $buttonsDeliveryType = $(".radio-buttons-wrapper input");
	var $deliveryPointBlock = $(".label-group.delivery-point");
	var $selectPointElement = $deliveryPointBlock.find("[name=\"delivery-point\"]");
	var $mapWrapper = $deliveryPointBlock.find(".yandex-map-wrapper");
	
	correctLabelBorders( $(".order-content-wrapper label.selected") );
	
	// Табы, которые переключают форму
	$tabsForm.on("click", ".tab-button-item", function() {
		var $clicked = $(this);
		$clicked.siblings().removeClass("active");
		$clicked.addClass("active");
		$tabsForm.find(".tab-content-item").hide().eq($clicked.index()).fadeIn();
	});
	
	
	// Валидация полей:
	$orderForm.find("input[type=\"text\"]").add($(".subscribe-form input[name=\"email\"], textarea")).on("input", function() {
		var $currentInput = $(this);
				var value = $(this).val();
				var name = $currentInput.attr("name");
				var $errorElement = $("<span class=\"invalid-input\"></span>");
	
		if(value !== "") {
			// Текстовые поля:
			if(name === "name" || name === "surname") {
				if(value.match(/^[а-яА-ЯёЁ\s\-]*$/g)) {
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
				if(value.match(/[a-zA-Z]/g) && !value.match(/[а-яА-ЯёЁ]/g) && value.indexOf("@") !== -1) {
					$currentInput.removeClass("invalid-value");
					$currentInput.next().remove();
					return;
				}
	
				if(!$currentInput.next().is(".invalid-input")) {
					$errorElement.text("Недопустимые символы. Это поле может содержать только латиницу и знак \"@\".");
					if($currentInput.hasClass("footer-email")) $errorElement.css({"position": "absolute"});
					$currentInput.after($errorElement);
				}
				$currentInput.addClass("invalid-value");
			}

			if(name === "phone") {

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
	$orderForm.on("keydown", "[name=\"phone\"]", function(event) {
		var data = event.keyCode;

			var	value = $(this).val();
	
		if(data !== 8) {
			if((data < 48 || data > 58) || value.length >= 13) return false;
			if(value.length === 3 || value.length === 7 || value.length === 10) $(this).val(value+" ");
		}
	
	});
	
	// Обработка выбора способа доставки.
	$buttonsDeliveryType.on("click", function() {
		var $clicked = $(this);
		var $clickedLabel = $clicked.parents("label");
		var valuePrice = +$clicked.val();
		var type = $clicked.attr("data-type");
	
		if(type === "Самовывоз") {
			$deliveryPointBlock.addClass("active");
		var currentSelectedPoint = $selectPointElement.val();
					var pointInfo = $selectPointElement.find("option:selected").attr("data-point-info");
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
	$selectPointElement.on("change", function() {
		var selectedPoint = $(this).val();
		var	pointInfo = $(this).find("option:selected").attr("data-point-info");
	
		if(selectedPoint === lastSelectedPoint) return;
	
		$mapBlock.remove();
		$mapBlock = $("<div class=\"yandex-map\" id=\"yandex-map\"></div>");
		$mapBlock.append( $("<div class=\"point-info\">" + pointInfo + "</div>") );
		$mapWrapper.append($mapBlock);
		ymaps.ready(init.bind(null, selectedPoint));
	
		lastSelectedPoint = selectedPoint;
	});
	
	var maxFooterItemHeight = getMaxHeight($(".footer-menu-item"));
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
		var values = $elements.map(function() {
			return $(this).height();
		}).toArray();
	
		return Math.max.apply(this, values);
	}
	
	/**
	 * @description Высчитывает и выводит данные о стоимости заказа.
	 * 
	 * @param {Number} value Стоимость доставки.
	 * @param {String} type Тип доставки.
	 */
	function outputOrderData(value, type) {
		var goodsCount = $orderDataPanel.find(".order-goods-info .data-list-item").length;
				var tempPrice  = $orderDataPanel
						.find(".order-goods-info .data-list-item").map(function() { return +$(this).find(".list-item-value").text().replace(/\D/g, "");})
						.toArray()
						.reduce(function(total, priceItem) {
							return total += priceItem;
						}, 0);
	
		var discount = (tempPrice <= 0) ? 0 : Math.floor(tempPrice * 0.05);
		tempPrice -= discount;
		var finalPrice = tempPrice + value;
	
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
			var arrayCoords = coords.split(" ").map(function(item) { return +item });
	
			yandexMap = new ymaps.Map("yandex-map", {
					center: arrayCoords,
					controls: [],
					zoom: 16
			});
			
			var placemark = new ymaps.Placemark(arrayCoords, {
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
