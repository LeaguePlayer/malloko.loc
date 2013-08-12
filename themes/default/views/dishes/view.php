<?php
$this->breadcrumbs=array(
	'Dishes'=>array('index'),
	$model->title,
);

<h1>View Dishes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'gallery',
		'place_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
