ymaps.ready(init);
             
function init() {
    // Создание карты.
    // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/
    var myMap = new ymaps.Map("map", {
        center: [55.76, 37.64],
        zoom: 12,
        controls: [
            'zoomControl', // Ползунок масштаба
            'fullscreenControl', // Полноэкранный режим
        ]
    });
    
    var address = 'Москва, ул. Льва Толстого, 16';
    var geocoder = ymaps.geocode(address);
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
/*


<?php foreach ($list as $row): ?>
var myPlacemark = new ymaps.Placemark([
<?php echo $row['point']; ?>
], {
balloonContent: '<?php echo $row['name']; ?>'
}, {
preset: 'islands#icon',
iconColor: '#0000ff'
});

<?php endforeach; ?>


*/
}