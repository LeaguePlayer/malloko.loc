<?php
$this->breadcrumbs=array(
	'Places'=>array('index'),
	$model->title,
);

<h1>View Places #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'title',
		'html_description',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
