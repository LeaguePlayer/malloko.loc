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
		'img_1',
		'img_2',
		'gllr_slides',
		'gllr_thumbs',
		'dttm_datetime',
		'dt_date',
		'tm_time',
		'dttm_datetime2',
		'wswg_content',
		'wswg_description',
		'msk_field',
		'msk_field2',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
