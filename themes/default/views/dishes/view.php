<?php $this->beginClip('r_sidebar'); ?>
	<section class="other_dishes">
		<?php if ($othersMenu->totalItemCount != 0): ?>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$othersDishes,
				'itemsCssClass'=>'items galleries_list',
				'itemView'=>'_view',
				'template'=>'{items}',
			)); ?>
		<?php endif; ?>
	</section>
<?php $this->endClip(); ?>

<h1 class="title"><?php echo $model->title; ?></h1>

<div class="dish-photos">

	<div class="text">
		<p><?php echo $model->description; ?></p>
	</div>
    
	<div class="photos">
		<?php foreach ($model->getGallery()->galleryPhotos as $photo): ?>
            <div class="one-photo">
                <h3><?php echo $photo->name; ?></h3>
                <img src="<?php echo $photo->getPreview('view'); ?>"/>
                <p><?php echo $photo->description; ?></p>
                <a rel="photo-group" class="fancybox" title="<?php echo $photo->name; ?>" href="<?php echo $photo->getPreview(); ?>"></a>
            </div>
		<?php endforeach; ?>
	</div>
    
    
</div>
