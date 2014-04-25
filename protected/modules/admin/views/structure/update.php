<?php
$this->breadcrumbs=array(
    "Разделы сайта"=>array('list', 'opened' => $model->id),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Список разделов', 'url'=>array('list', 'opened' => $model->id)),
	array('label'=>'Материал →', 'url'=>array('/admin/structure/updateMaterial', 'node_id'=>$model->id)),
);
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>
<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'parent'=>$parent
)); ?>