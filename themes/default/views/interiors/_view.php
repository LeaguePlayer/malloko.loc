<div class="item">
	<div class="photo">
		<?php foreach ($data->galleryManager->getGallery()->galleryPhotos as $photo): ?>
			<a href="<?php echo $data->viewUrl; ?>"><img class="adipoli" src="<?php echo $photo->getPreview('medium'); ?>" alt=""></a>
			<?php break; ?>
		<?php endforeach; ?>
	</div>
	<div class="title">
		<h3 class="name"><?php echo $data->title;?></h3>
	</div>
	<div class="count"><?php echo $data->getCountPhotos(); ?> фото</div>
</div>