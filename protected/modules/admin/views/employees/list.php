<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'employees-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageRounded($data->getThumb("small"))'
		),
		'fio',
		'position',
		array(
			'name'=>'face_of_day',
			'type'=>'raw',
			'value'=>'$data->isFaceOfDay()',
			'filter'=>array(1=>'Да', 0=>'Нет')
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Employees::getStatusAliases($data->status)',
			'filter'=>array(Employees::getStatusAliases())
		),
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->create_time)'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->update_time)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>''
		),
	),
)); ?>
