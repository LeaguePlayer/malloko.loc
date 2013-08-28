<?php
/* @var $this BrandsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Brands',
);

$this->menu=array(
	array('label'=>'Create Brands', 'url'=>array('create')),
	array('label'=>'Manage Brands', 'url'=>array('admin')),
);
?>

<h1>Brands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
