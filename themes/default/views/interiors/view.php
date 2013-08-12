<?php
$this->breadcrumbs=array(
	'Interiors'=>array('index'),
	$model->title,
);

<h1>View Interiors #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'place_id',
		'gallery',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
