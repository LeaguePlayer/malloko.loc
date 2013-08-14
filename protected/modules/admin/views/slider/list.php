<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление Слайдером</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'slider-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		array(
			'name'=>'place_id',
			'type'=>'raw',
			'value'=>'$data->place->title',
			'filter'=>CHtml::listData(Places::model()->findAll(), 'id', 'title')
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Slider::getStatusAliases($data->status)',
			'filter'=>array(Slider::getStatusAliases())
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
