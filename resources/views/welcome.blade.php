<!DOCTYPE html>
<html>
<head><meta http-equiv=Content-Type content='text/html; charset=utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <title>Своя Яндекс карта</title>
    <meta name="description" content="Своя Яндекс карта">
    <script src="js/jquery-3.1.1.min.js"   type="text/javascript"></script>     
    <script src="https://api-maps.yandex.ru/2.0/?load=package.standard,package.geoObjects&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        // Инициализация карты
        ymaps.ready(init);
 
        function init () {
            
            //Центрирование и выбор масштаба карты
               var myMap = new ymaps.Map('map', {
                    center: [55.757741, 37.624725],  
                    zoom: 18
                });
 
           // Создание своей метки 
                var myPlacemark = new ymaps.Placemark(
                // Координаты метки
                    [55.757741,37.624725] , {
                    // Свойства метки
                    hintContent: 'Мой маркер'                //Подсказка при наведении на маркер
                }, {
                    iconImageHref: 'http://delay-delo.com/demo/icono_metas.png',  // картинка иконки
                    iconImageSize: [45, 45],                                      // размеры картинки
                    iconImageOffset: [-70, -40]                                   // смещение картинки
                    });     
 
                // Добавление метки на карту
                myMap.geoObjects.add(myPlacemark);

                //Элементы управления    
                myMap.controls
                // Кнопка изменения масштаба
                    .add('zoomControl')
                    // Список типов карты
                    .add('typeSelector')
                    // Кнопка изменения масштаба - справа
                    .add('smallZoomControl', { right: 5, top: 75 })
                    // Стандартный набор кнопок
                    .add('mapTools')    
                    //Линейка масштаба
                   .add(new ymaps.control.ScaleLine());
        }
    
    </script>
  <style>
           /*Размер карты*/
           #map { width:100%;height:500px }
           /*Отображение карты в черно-белом цвете */
           .ymaps-glass-pane, .ymaps-layers-pane {filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale") !important;
    /* Firefox 3.5+ Chrome 19+ & Safari 6+ */
    -webkit-filter: grayscale(100%) !important;  
}
    </style>
        
</head>
<body>
  
    <h1 text-align="center">Своя Яндекс карта</h1>
     
    <div id="map"></div>
      
</body>
</html>