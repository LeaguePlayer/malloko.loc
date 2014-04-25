<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list'),
    "Новости"=>array('/admin/newsList/update', 'id'=>$model->list_id),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Новости','url'=>array('/admin/newsList/update', 'id'=>$model->list_id)),
    array('label'=>'Добавить новую','url'=>array('/admin/news/create', 'list_id'=>$model->list_id)),
);
?>

<h3>Редактирование новости "<?php echo $model->title ?>"</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>