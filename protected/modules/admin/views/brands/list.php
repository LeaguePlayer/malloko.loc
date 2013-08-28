<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'brands-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageCircle($data->imgBehavior1->getImageUrl("icon"))'
		),
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageCircle($data->imgBehavior2->getImageUrl("icon"))'
		),
		'gllr_slides',
		'gllr_thumbs',
		array(
			'name'=>'dttm_datetime',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dttm_datetime)'
		),
		array(
			'name'=>'dt_date',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dt_date)'
		),
		'tm_time',
		array(
			'name'=>'dttm_datetime2',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dttm_datetime2)'
		),
		'msk_field',
		'msk_field2',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Brands::getStatusAliases($data->status)',
			'filter'=>Brands::getStatusAliases()
		),
		'sort',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', $data->create_time)'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', $data->update_time)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
