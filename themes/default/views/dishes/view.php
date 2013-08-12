<?php $this->beginClip('r_sidebar'); ?>
	<section class="other_dishes">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$othersDishes,
			'itemsCssClass'=>'items galleries_list',
			'itemView'=>'_view',
			'template'=>'{items}',
		)); ?>
	</section>
<?php $this->endClip(); ?>

<h1 class="title"><?php echo $model->title; ?></h1>

<article class="chronicle event">
	<div class="content">
		<div class="text">
			<p><?php echo $model->description; ?></p>
		</div>
		<div class="photos stalactite">
			<?php foreach ($model->getGallery()->galleryPhotos as $photo): ?>
				<a rel="photo-group" class="fancy" title="<?php echo $photo->description; ?>" href="<?php echo $photo->getPreview(); ?>"><img src="<?php echo $photo->getPreview('view'); ?>"></a>
			<?php endforeach; ?>
		</div>
		<div class="clear"></div>
	</div>
</article>
