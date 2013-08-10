<?php
/*
 * @var $model
 */
?>
<li data-timestamp="<?php echo strtotime($model->public_date); ?>">
	<img width="72" src="<?php echo $model->getThumb('small'); ?>" alt="">
	<div class="descriptiom">
		<span class="date"><?php echo $model->publicDay.' '.$model->publicMonth; ?></span>
		<span class="title"><?php echo $model->title; ?></span>
	</div>
	<a href="<?php echo $model->viewUrl(); ?>"></a>
</li>