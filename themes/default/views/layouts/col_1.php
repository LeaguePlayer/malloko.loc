<?php /* @var $this Controller */ ?>

<?php if ( !isset($this->clips['l_sidebar']) ): ?>
<?php $this->beginClip('l_sidebar'); ?>
	<section class="contacts">
		<div class="map_border">
			<div class="map">
				<img src="/assets/img/tmp/map-lite.jpg" alt="">
			</div>
		</div>
		<h2>Ресторан Золотая Черепаха</h2>
		<p class="address">г. Тюмень, ул. Володарского, д.9</p>
		<p class="phone">8 3452 45 24 58</p>
	</section>

	<nav class="navigation">
		<ul class="nav_menu">
			<li><a href="<?php echo Pages::getUrlByAlias('about'); ?>" class="about">О ресторане</a></li>
			<li><a href="<?php echo $this->createUrl('/menu/index'); ?>" class="menu">Меню</a></li>
			<li><a href="<?php echo $this->createUrl('/employees/index'); ?>" class="personal">Команда</a></li>
			<li><a href="#" class="interior">Интерьер</a></li>
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