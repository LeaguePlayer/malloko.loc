<?php
$this->breadcrumbs=array(
    "Разделы сайта"=>array('list'),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Список разделов', 'url'=>array('list')),
    array('label'=>'Материал →', 'url'=>array('updateMaterial', 'node_id' => $model->id)),
);
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>
<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'parent'=>$parent
)); ?>