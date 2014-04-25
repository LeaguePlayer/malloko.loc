<div>
	<h2><?php echo $node->name ?></h2>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'separator'=>' → ',
		'links'=>$this->breadcrumbs,
	)); ?>
</div>


<div>
	<?php echo $page->wswg_body ?>

	<?php
		$galleries = $page->getGalleries();
	?>
	<?php if ( count($galleries) ): ?>
		<div class="object-gallery">
			<div class="seasons">
				<?php $counter = 0; foreach ( $galleries as $gallery ): ?>
					<div class="season">
						<?php foreach ( $gallery->galleryPhotos as $photo ): ?>
							<a href="<?= $photo->getUrl() ?>" rel="season<?= $counter ?>"><?= $photo->getImage() ?></a>
						<?php endforeach ?>
					</div>
					<?php $counter++ ?>
				<?php endforeach ?>
			</div>
		</div>
	<?php endif ?>
</div>