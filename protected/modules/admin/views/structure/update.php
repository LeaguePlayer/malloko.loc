<?php
$this->breadcrumbs=array(
    "Разделы сайта"=>array('list'),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Список разделов', 'url'=>array('list')),
);
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>
<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'parent'=>$parent
)); ?>