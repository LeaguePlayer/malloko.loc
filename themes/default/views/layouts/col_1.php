<?php /* @var $this Controller */ ?>

<?php if ( !isset($this->clips['l_sidebar']) ): ?>
<?php $this->beginClip('l_sidebar'); ?>
	<section class="contacts">
		<div class="map_border">
			<div id="map-mini" class="map"></div>
		</div>
		<h2><?php echo $this->place['title']; ?></h2>
		<p id="address" class="address"><?php echo Settings::getOption('address'); ?></p>
		<p class="phone"><?php echo Settings::getOption('phone'); ?></p>
		<script type="text/javascript">
		/*<![CDATA[*/
			$(document).ready(function() {
				ymaps.ready(function () {
					var myMap;
					// Создание экземпляра карты и его привязка к созданному контейнеру.
					ymaps.geocode($('#address').text(), {
						results: 1
					}).then(function (res) {
						var firstGeoObject = res.geoObjects.get(0);
						myMap = new ymaps.Map("map-mini", {
							center: firstGeoObject.geometry.getCoordinates(),
							zoom: 14,
							behaviors: ['default', 'scrollZoom']
						});

						// Создание метки с пользовательским макетом балуна.
						var myPlacemark = window.myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
							addres: $('#address').text(),
						}, {
							iconImageHref: '<?= $this->getAssetsUrl() . '/img/marker.png'; ?>',
							// Не скрываем иконку при открытом балуне.
							// hideIconOnBalloonOpen: false,
							// И дополнительно смещаем балун, для открытия над иконкой.
							//balloonOffset: [9, -40]
						});

						myMap.geoObjects.add(myPlacemark);
					});
				});
			});
		/*]]>*/
		</script>
	</section>

	<nav class="navigation">
		<ul class="nav_menu">
			<li><a href="<?php echo Pages::getUrlByAlias('about'); ?>" class="about">О ресторане</a></li>
			<li><a href="<?php echo $this->createUrl('/menu/index'); ?>" class="menu">Меню</a></li>
			<li><a href="<?php echo $this->createUrl('/employees/index'); ?>" class="personal">Команда</a></li>
			<li><a href="<?php echo $this->createUrl('/interiors/index'); ?>" class="interior">Интерьер</a></li>
			<li><a href="<?php echo Events::getNewsUrl(); ?>" class="news">Новости</a></li>
			<li><a href="<?php echo Events::getChroniclesUrl(); ?>" class="chronic">Светская хроника</a></li>
			<li><a href="<?php echo $this->createUrl('/dishes/index'); ?>" class="photo">Фото блюд</a></li>
		</ul>
	</nav>
<?php $this->endClip(); ?>
<?php endif; ?>


<?php $this->beginContent('//layouts/main'); ?>

<div id="layout" class="fix-width">
	<!-- <begin Left Side> -->

	<aside class="l_side">
		<?php echo $this->clips['l_sidebar'];?>
	</aside>
	<!-- <end Left Side> -->


	<section class="content col_1">
		<?php echo $content; ?>
	</section>


	<aside class="r_side">
		<?php echo $this->clips['r_sidebar'];?>
	</aside>
	<div class="clear"></div>
</div>

<?php $this->endContent(); ?>