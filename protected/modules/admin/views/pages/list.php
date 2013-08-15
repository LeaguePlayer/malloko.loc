<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		array(
			'header'=>'Ссылка на страницу',
			'type'=>'raw',
			'value'=>'TbHtml::link($data->viewUrl, $data->viewUrl, array("class"=>"f-iframe", "data-fancybox-type"=>"iframe"))'
		),
		'title',
		/*
		array(
			'name'=>'place_id',
			'type'=>'raw',
			'value'=>'$data->place->title',
			'filter'=>CHtml::listData(Places::model()->findAll(), 'id', 'title')
		),
		 */
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Pages::getStatusAliases($data->status)',
			'filter'=>array(Pages::getStatusAliases())
		),
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->createDate'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->updateDate'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array(
				'view' => array (
					'url'=>'$data->viewUrl',
					'options'=>array(
						'class'=>'view f-iframe',
						'data-fancybox-type'=>'iframe',
					),
				),
			)
		),
	),
)); ?>
