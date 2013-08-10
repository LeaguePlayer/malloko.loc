<?php $this->beginClip('r_sidebar'); ?>
	<section class="banners">
		<a href="#"><img src="/assets/img/tmp/banner.jpg" alt=""></a>
	</section>

	<section class="face">
		<h2>Лицо ресторана</h2>
		<div class="img_border">
			<div class="img_round">
				<img src="/assets/img/tmp/face.jpg" alt="">
			</div>
		</div>
		<p class="name">Черепанова Светлана Анатольевна</p>
		<p class="post">Директор ресторана</p>
	</section>

	<section class="reviews">
		<h2 class="caption">Отзывы клиентов</h2>
		<ul>
			<li class="item">
				<h3 class="name">Игорь пишет:</h3><span class="date">23 июня 2013</span>
				<p class="review">Очень хороший ресторан. Рад, что в Тюмени есть такие заведения.</p>
			</li>
			<li class="item">
				<h3 class="name">Игорь пишет:</h3><span class="date">23 июня 2013</span>
				<p class="review">Очень хороший ресторан. Рад, что в Тюмени есть такие заведения.</p>
			</li>
		</ul>
		<div class="progress">
			<span class="loader"></span><a href="#" class="more">Еще отзывы</a>
		</div>

		<div class="add_review">
			<p>Поделитесь впечатлениями о нашем ресторане</p>
			<a href="#">Оставить отзыв</a>
		</div>				
	</section>
<?php $this->endClip(); ?>



<?php echo $this->renderPartial( '_news', array('dataProvider' => Events::lastNews($this->place['id'])) ); ?>
<?php echo $this->renderPartial( '_chronicles', array('dataProvider' => Events::lastChronicles($this->place['id'])) ); ?>