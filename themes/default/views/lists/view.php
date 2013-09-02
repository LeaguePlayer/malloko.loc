<?php
$this->breadcrumbs=array(
	'Lists'=>array('index'),
	$model->id,
);

<h1>View Lists #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
