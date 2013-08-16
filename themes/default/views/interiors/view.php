<?php $this->beginClip('r_sidebar'); ?>
	<section class="other_interiors">
		<?php if ($othersInteriors->totalItemCount != 0): ?>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$othersInteriors,
				'itemsCssClass'=>'items interiors_list',
				'itemView'=>'_side_view',
				'template'=>'{items}',
			)); ?>
		<?php endif; ?>
	</section>
<?php $this->endClip(); ?>

<h1 class="title"><?php echo $model->title; ?></h1>

<article class="chronicle event">
	<div class="content">
		<div class="photos stalactite">
			<?php foreach ($model->getGallery()->galleryPhotos as $photo): ?>
				<a rel="photo-group" class="fancy" title="<?php echo $photo->description; ?>" href="<?php echo $photo->getPreview(); ?>"><img src="<?php echo $photo->getPreview('view'); ?>"></a>
			<?php endforeach; ?>
		</div>
		<div class="clear"></div>
	</div>
</article>
