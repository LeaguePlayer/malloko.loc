<?php
	/*
	 * @var $model
	 * @var $roundData
	 */
?>


<article class="news">
	<h1><span class="date"><strong><?php echo $model->publicDay; ?></strong> <?php echo $model->publicMonth; ?></span><?php echo $model->title;?></h1>
	<div class="content">
		<img src="<?php echo $model->getThumb('big'); ?>" alt="">
		<div class="event_date"><span class="number"><?php echo $model->publicDay; ?></span> <?php echo $model->publicMonth; ?>. <?php if ( $model->publicTime !== null ) echo "Начало в {$model->publicTime}"; ?></div>
		<?php echo $model->html_content; ?>
		<div class="clear"></div>
	</div>
</article>
<div class="likes">
	<h3>Понравилось?</h3>
	<div class="widget"><img src="/assets/img/tmp/soc_likes.png" alt=""></div>
</div>

<div class="news_rounder" data-startTimestamp="<?php echo strtotime($model->public_date); ?>">
	<a href="#" class="prev"></a>
	<a href="#" class="next"></a>
	<div class="round_wrapper">
		<ul class="round">
			<?php foreach ( $roundData->getData() as $data ): ?>
				<?php echo $this->renderPartial('_roundItem', array('model' => $data)); ?>
			<?php endforeach; ?>
		</ul>
	</div>
</div>