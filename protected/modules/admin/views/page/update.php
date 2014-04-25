<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list', 'opened' => $model->node->id),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list', 'opened' => $model->node->id)),
    array('label'=>'Добавить новую','url'=>array('create', 'node_id'=>$model->node->id)),
	array('label'=>'← Раздел', 'url'=>array('/admin/structure/update', 'id'=>$model->node->id)),
);
?>

<h2><?php echo $model->node->name; ?></h2>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>