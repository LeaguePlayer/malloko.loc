<?php
	/*
	 * @var $model
	 * @var $roundData
	 */
?>

<?php if ($model->type == Events::TYPE_NEWS): ?>
	<article class="news event">
		<h1><span class="date"><strong><?php echo $model->publicDay; ?></strong> <?php echo $model->publicMonth; ?></span><?php echo $model->title;?></h1>
		<div class="content">
			<img src="<?php echo $model->getThumb('big'); ?>" alt="">
			<div class="event_date"><span class="number"><?php echo $model->publicDay; ?></span> <?php echo $model->publicMonth; ?>. <?php if ( $model->publicTime !== null ) echo "Начало в {$model->publicTime}"; ?></div>
			<?php echo $model->html_content; ?>
			<div class="clear"></div>
		</div>
	</article>
<?php else: ?>
	<article class="chronicle event">
		<h1><span class="date"><strong><?php echo $model->publicDay; ?></strong> <?php echo $model->publicMonth.'<br>'.$model->publicYear; ?></span><?php echo $model->title;?></h1>
		<div class="content">
			<div class="text">
				<?php echo $model->html_content; ?>
			</div>
			<img src="<?php echo $model->getThumb('stretch'); ?>" alt="">
			<div class="photos stalactite">
				<?php foreach ($model->getGallery()->galleryPhotos as $photo): ?>
					<a rel="photo-group" class="fancy" title="<?php echo $photo->description; ?>" href="<?php echo $photo->getPreview(); ?>"><img src="<?php echo $photo->getPreview('medium'); ?>"></a>
				<?php endforeach; ?>
			</div>
			<div class="clear"></div>
		</div>
	</article>
<?php endif; ?>


<div class="likes">
	<h3>Понравилось?</h3>
	<div class="widget">
		<?php Yii::app()->clientScript->registerScriptFile('//vk.com/js/api/openapi.js?98', CClientScript::POS_HEAD); ?>
		<?php Yii::app()->clientScript->registerScript('vkinit', "VK.init({apiId: 3820677, onlyWidgets: true});", CClientScript::POS_BEGIN); ?>
		<!-- Put this div tag to the place, where the Like block will be -->
		<div id="vk_like"></div>
		<?php Yii::app()->clientScript->registerScript('vklike', "VK.Widgets.Like(\"vk_like\", {type: \"button\"});", CClientScript::POS_READY); ?>
	</div>
	
	<div class="widget">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Freference%2Fplugins%2Flike&amp;width=200&amp;height=22&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false&amp;appId=232938120187606" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:22px;" allowTransparency="true"></iframe>
	</div>
</div>

<div class="news_rounder" data-start_timestamp="<?php echo strtotime($model->public_date); ?>">
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