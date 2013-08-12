<?php
/* @var $this DishesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dishes',
);

$this->menu=array(
	array('label'=>'Create Dishes', 'url'=>array('create')),
	array('label'=>'Manage Dishes', 'url'=>array('admin')),
);
?>

<h1>Dishes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
