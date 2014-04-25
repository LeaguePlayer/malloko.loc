<?php
$this->menu=array(
);
?>

<h1>Управление галереями</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		array(
			'name' => 'gallery_name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->gallery_name, array("/admin/gallery/view", "id" => $data->id))',
		),
		'alias',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(
					'url'=>'array("/admin/gallery/deleteGallery", "id" => $data->id)'
				)
			),
		),
	),
)); ?>
