
<!DOCTYPE html>
<html>
<head>
    <title>Компании</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  
</head>
<body>
<div class="container">
	<a href="{{url('/users')}}" class="btn btn-success">Сотрудники</a>
	<a href="{{url('/company')}}" class="btn btn-success">Компании</a>
	<div id="map" style="width: 100%; height:500px"></div>
</div>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
	ymaps.ready(init);

	function init() {
		var myMap = new ymaps.Map("map", {
			center: [55.791845, 49.157645],
			zoom: 16
		}, {
			searchControlProvider: 'yandex#search'
		});

		var myCollection = new ymaps.GeoObjectCollection();

		<?php foreach ($company as $row) : ?>
			<?php foreach ($row->users as $user) : ?>
				var myPlacemark = new ymaps.Placemark([
						<?php echo $row['points']; ?>
					],

					{
						balloonContentHeader: '<?php echo $row['company']; ?>',
						balloonContent: '<?php echo $user['name']; ?>'
					}, {
						preset: 'islands#icon',
						iconColor: '#0000ff'
					});
				myCollection.add(myPlacemark);
			<?php endforeach; ?>
		<?php endforeach; ?>

		myMap.geoObjects.add(myCollection);


		myMap.setBounds(myCollection.getBounds(), {
			checkZoomRange: true,
			zoomMargin: 9
		});
	}
</script>
</body>
</html>