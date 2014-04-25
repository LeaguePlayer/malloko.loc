<?php
	$this->menu = array(
		array('label' => 'К списку галерей', 'url' => array('manage')),
	);

	$this->widget('appext.imagesgallery.GalleryManager', array(
		'gallery' => $model,
		'controllerRoute' => '/admin/gallery',
		'enableUnlinkButton' => false,
		'enableDeleteButton' => false,
	));
?>