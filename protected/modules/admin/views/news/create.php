<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list'),
    "Новости"=>array('/admin/newsList/update', 'id'=>$model->list_id),
    'Создание',
);

$this->menu=array(
    array('label'=>'Новости','url'=>array('/admin/newsList/update', 'id'=>$model->list_id)),
);
?>

<h3>Добавление новости</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>