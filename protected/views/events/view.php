<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
);

<h1>View Events #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'html_content',
		'gallery',
		'place_id',
		'type',
		'public_date',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
