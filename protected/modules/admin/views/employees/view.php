<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
    array('label'=>'Редактировать','url'=>array('update')),
    array('label'=>'Удалить','url'=>array('delete')),
);
?>

<h1>Информация о сотруднике "<?php echo $model->fio; ?>"</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'fio',
		'position',
        array(
            'type' => 'raw',
            'value' => '$model->html_quote',
        ),
	),
)); ?>
