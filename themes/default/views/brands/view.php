<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->id,
);

<h1>View Brands #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dt_timer',
		'dttm_timer',
		'tm_timer',
		'img_sddd',
		'img_sdfsdf',
		'wswg_3434',
		'wswg_5656',
		'gllr_timer',
		'gllr_dfdfdfdf',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
