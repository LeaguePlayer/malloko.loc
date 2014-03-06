<?php
$this->breadcrumbs=array(
    "Разделы сайта"=>array('list'),
    'Создание',
);

$this->menu=array(
    array('label'=>'Список разделов','url'=>array('list')),
);
?>

<h2>Создание раздела сайта</h2>
<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'parent'=>$parent
)); ?>