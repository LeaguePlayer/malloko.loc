
<?php $this->beginClip('r_sidebar'); ?>
	<?php $this->widget('application.extensions.banner.BannerWidget'); ?>
<?php $this->endClip(); ?>

<?php
	echo $model->html_content;
?>



<?php if ( $model->alias === 'contacti' ): ?>
<input id="address" type="hidden" style="display:none;" value="<?php echo Settings::getOption('address'); ?>">

<script type="text/javascript">
/*<![CDATA[*/
	$(document).ready(function() {
		ymaps.ready(function () {
			var myMap;
			// Создание экземпляра карты и его привязка к созданному контейнеру.
			ymaps.geocode($('#address').val(), {
                results: 1
            }).then(function (res) {
				var firstGeoObject = res.geoObjects.get(0);
                myMap = new ymaps.Map("map", {
					center: firstGeoObject.geometry.getCoordinates(),
					zoom: 16,
					behaviors: ['default']
				});

				// Создание метки с пользовательским макетом балуна.
				var myPlacemark = window.myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
					addres: $('#address').val(),
				}, {
					iconImageHref: '<?= $this->getAssetsUrl() . '/img/marker.png'; ?>',
				    // Не скрываем иконку при открытом балуне.
					// hideIconOnBalloonOpen: false,
				    // И дополнительно смещаем балун, для открытия над иконкой.
					// balloonOffset: [3, -30]
				});

				myMap.geoObjects.add(myPlacemark);
			});
		});
	});
/*]]>*/
</script>
<?php endif; ?>