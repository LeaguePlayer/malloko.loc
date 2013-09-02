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
    'afterAjaxUpdate'=>"function() {sortGrid('brands')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".$data->status,
    )',
	'columns'=>array(
		array(
			'name'=>'dt_timer',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dt_timer)'
		),
		array(
			'name'=>'dttm_timer',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dttm_timer)'
		),
		'tm_timer',
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageCircle($data->imgBehaviorSddd->getImageUrl("icon"))'
		),
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageCircle($data->imgBehaviorSdfsdf->getImageUrl("icon"))'
		),
		'gllr_timer',
		'gllr_dfdfdfdf',
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

<?php Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("brands");', CClientScript::POS_END) ;?>