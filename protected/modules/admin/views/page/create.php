<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list'),
    'Создание',
);

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
);
?>

<h2>Новая стрница</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>