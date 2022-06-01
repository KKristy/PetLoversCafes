// Функция ymaps.ready() будет вызвана, когда
// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);

    function init() {
        // Создание карты.
        // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчнию: «широта, долгота».
            center: [55.76, 37.64],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 12,
            // Элементы управления
            // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/controls/standard-docpage/
            controls: [

                'zoomControl', // Ползунок масштаба
                'rulerControl', // Линейка
                'routeButtonControl', // Панель маршрутизации
                'trafficControl', // Пробки
                'typeSelector', // Переключатель слоев карты
                'fullscreenControl', // Полноэкранный режим

                // Поисковая строка
                new ymaps.control.SearchControl({
                    options: {
                        // вид - поисковая строка
                        size: 'large',
                        // Включим возможность искать не только топонимы, но и организации.
                        provider: 'yandex#search'
                    }
                })

            ]
        });

        // Добавление метки
        // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark-docpage/
        var myPlacemark = new ymaps.Placemark([55.76, 37.64], {
            // Хинт показывается при наведении мышкой на иконку метки.
            hintContent: 'Содержимое всплывающей подсказки',
            // Балун откроется при клике по метке.
            balloonContent: 'Содержимое балуна'
        });

        // После того как метка была создана, добавляем её на карту.
        myMap.geoObjects.add(myPlacemark);
    }


//Для одной записи
ymaps.ready(init);
function init() {
	var myMap = new ymaps.Map("map", {
		center: [<?php echo $object['point']; ?>],
		zoom: 16
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	var myCollection = new ymaps.GeoObjectCollection(); 
 
	// Добавим метку красного цвета.
	var myPlacemark = new ymaps.Placemark([
		<?php echo $object['point']; ?>
	], {
		balloonContent: '<?php echo $object['name']; ?>'
	}, {
		preset: 'islands#icon',
		iconColor: '#ff0000'
	});
	myCollection.add(myPlacemark);
 
	myMap.geoObjects.add(myCollection);
}


//Для многих сразу
<script type="text/javascript">
ymaps.ready(init);
function init() {
	var myMap = new ymaps.Map("map", {
		center: [<?php echo $list[0]['point']; ?>],
		zoom: 16
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	var myCollection = new ymaps.GeoObjectCollection(); 
	<?php foreach ($list as $row): ?>
	var myPlacemark = new ymaps.Placemark([
		<?php echo $row['point']; ?>
	], {
		balloonContent: '<?php echo $row['name']; ?>'
	}, {
		preset: 'islands#icon',
		iconColor: '#0000ff'
	});
	myCollection.add(myPlacemark);
	<?php endforeach; ?>
 
	myMap.geoObjects.add(myCollection);
	
	// Сделаем у карты автомасштаб чтобы были видны все метки.
	myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
}
</script>


//Геокодер
ymaps.ready(init);
function init() {
 
    // Создание карты.
    var myMap = new ymaps.Map("map", {
        center: [56, 37],
        zoom: 12,
    });
 
    // Строка с адресом, который необходимо геокодировать
    var address = 'Москва, ул. Льва Толстого, 16';
 
    // Ищем координаты указанного адреса
    // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode-docpage/
    var geocoder = ymaps.geocode(address);
 
    // После того, как поиск вернул результат, вызывается callback-функция
    geocoder.then(
        function (res) {
 
            // координаты объекта
            var coordinates = res.geoObjects.get(0).geometry.getCoordinates();
 
            // Добавление метки (Placemark) на карту
            var placemark = new ymaps.Placemark(
                coordinates, {
                    'hintContent': address,
                    'balloonContent': 'Время работы: Пн-Пт, с 9 до 20'
                }, {
                    'preset': 'islands#redDotIcon'
                }
            );
 
            myMap.geoObjects.add(placemark);
        }
    );
 
}


$sth = $dbh->prepare("SELECT * FROM `objects` ORDER BY `name`");
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);
function init() {
	var myMap = new ymaps.Map("map", {
		center: [<?php echo $list[0]['point']; ?>],
		zoom: 16
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	var myCollection = new ymaps.GeoObjectCollection(); 
 
	<?php foreach ($list as $row): ?>
	var myPlacemark = new ymaps.Placemark([
		<?php echo $row['point']; ?>
	], {
		balloonContent: '<?php echo $row['name']; ?>'
	}, {
		preset: 'islands#icon',
		iconColor: '#0000ff'
	});
	myCollection.add(myPlacemark);
	<?php endforeach; ?>
 
	myMap.geoObjects.add(myCollection);
	
	// Сделаем у карты автомасштаб чтобы были видны все метки.
	myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});

                                // Строка с адресом, который необходимо геокодировать
                                var address =<?php echo $row['address']; ?>;
                                var geocoder = ymaps.geocode(address);
                         
                            // После того, как поиск вернул результат, вызывается callback-функция
                                geocoder.then(
                                    function (res) {
                         
                                    // координаты объекта
                                        var coordinates = res.geoObjects.get(0).geometry.getCoordinates();
                                        <?php 
                                            $str ?> = var coordinates;
                                           <?php fwrite($fd, $str);
                                            fclose($fd); ?>
                         
                                        // Добавление метки (Placemark) на карту
                                        var placemark = new ymaps.Placemark(
                                            coordinates, {
                                                'hintContent': address,
                                                'balloonContent': '<?php echo $row['name']; ?>'
                                            }, {
                                                iconLayout: 'default#image',
                                                iconImageHref: 'img/for_map1.png',
                                                iconImageSize: [30, 42]
                                            }
                                        );
                         
                                        myMap.geoObjects.add(placemark);
                                    }
                                );
                        
                            <?php } ?>