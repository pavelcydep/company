                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
<div id="map" style="width: 100%; height:500px"></div>
                                                                                                                                                                                                                                                                                         
<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
ymaps.ready(init);
function init() {
	var myMap = new ymaps.Map("map", {
		center: [55.791845,49.157645] ,
		zoom: 16
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	var myCollection = new ymaps.GeoObjectCollection(); 
 
	<?php foreach ($company as $row): ?>
	var myPlacemark = new ymaps.Placemark([
		<?php echo $row['points']; ?>
	], {
		balloonContent: '<?php echo $row['company']; ?>'
	}, {
		preset: 'islands#icon',
		iconColor: '#0000ff'
	});
	myCollection.add(myPlacemark);
	<?php endforeach; ?>
 
	myMap.geoObjects.add(myCollection);
	
	
	myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
}
</script>