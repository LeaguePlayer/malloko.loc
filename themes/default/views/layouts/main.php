<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="<?=$this->getAssetsUrl()?>/css/style.css">
		<title>Золотая черепаха</title>
		<!--[if IE]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body <?php $this->is_home() ? print 'class="background"' : print '';?>>
		<header id="header" class="h_main">
			<section class="fix-width top">
				<div class="logo_container">
					<a href="/" class="logo">
						<img src="<?php echo $this->getAssetsUrl();?>/img/gold_turtle-logo.png" alt="">
					</a>
				</div>
				<div class="h-content">
					<div class="city gray">Тюмень</div>

					<ul class="main_menu">
						<li><a href="#">Главная</a></li>
						<li class="separator"></li>
						<li><a href="#">О нас</a></li>
						<li class="separator"></li>
						<li><a href="#">Контакты</a></li>
						<li class="separator"></li>
						<li><a href="#">Вакансии</a></li>
						<li class="separator"></li>
						<li><a href="#">Реклама</a></li>
						<li class="separator"></li>
						<li><a href="#">Партнеры</a></li>
					</ul>

					<div class="clear"></div>

					<ul class="action_menu">
						<li><a class="room" href="#">Выбор зала</a></li>
						<li><a class="news" href="#">новости</a></li>
						<li><a class="chronic" href="#">Светская хроника</a></li>
						<li><a class="order" href="#">Забронировать столик</a></li>
					</ul>

					<ul class="socials">
						<li><a class="twitter" href="#"></a></li>
						<li><a class="facebook" href="#"></a></li>
						<li><a class="vkontakte" href="#"></a></li>
					</ul>
				</div>
			</section>

			<?php if ( $this->is_home() and $this->sliderManager !== null ): ?>
			<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.slides.min.js', CClientScript::POS_END); ?>
			<section class="slider">
				<div class="slides">
					<?php foreach ($this->sliderManager->galleryPhotos as $slide): ?>
						<img src="<?php echo $slide->getPreview('big'); ?>">
					<?php endforeach; ?>
				</div>
				<!--
				<div class="viewport-wrap">
					<div class="buttons fix-width">
						<a href="#" class="prev"></a>
						<a href="#" class="next"></a>
					</div>
				</div>
				-->
			</section>
			<?php endif; ?>
		</header>

		<?php echo $content;?>

		<footer id="footer" class="fix-width center">
			<p class="reserved">(с) Ресторан Золотая Черепаха</p>
			<ul class="f_menu">
				<li><a href="#">Главная</a></li>
				<li><a href="#">О нас</a></li>
				<li><a href="#">Контакты</a></li>
				<li><a href="#">Реклама</a></li>
				<li><a href="#">Партнеры</a></li>
			</ul>
			<ul class="socials">
				<li><a class="twitter" href="#"></a></li>
				<li><a class="facebook" href="#"></a></li>
				<li><a class="vkontakte" href="#"></a></li>
			</ul>
			<p class="amobile"><a href="http://amobile-studio.ru/"></a><span>Всегда только лучшие идеи</span></p>
		</footer>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/common.js"></script>
	</body>
</html>