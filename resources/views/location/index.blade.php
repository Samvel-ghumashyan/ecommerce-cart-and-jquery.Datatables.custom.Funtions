<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div id="map" style="width: 100%; height: 500px;"></div>

<script src="https://api-maps.yandex.ru/2.1/?apikey=e416a337-bc7d-40a3-bb41-d2662583fa5e&lang=en_US" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var latitude = {{ $latitude }};
        var longitude = {{ $longitude }};

        var map = new ymaps.Map("map", {
            center: [latitude, longitude],
            zoom: 10
        });

        var placemark = new ymaps.Placemark([latitude, longitude], {}, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        });

        map.geoObjects.add(placemark);
    }
</script>


</body>
</html>
