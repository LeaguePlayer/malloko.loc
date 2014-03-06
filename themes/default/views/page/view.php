<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

<h1>View Page #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'wswg_body',
		'img_preview',
		'node_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
