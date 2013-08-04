<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id,
);

<h1>View Employees #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'fio',
		'position',
		'html_quote',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
