<?php
$this->breadcrumbs=array(
    "Меню"=>array('list'),
    'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить новый','url'=>array('create', 'parent_id'=>$model->parent_id)),
);
?>

<h3>Редактирование меню</h3>

<?php echo $this->renderPartial('_form',array(
    'model' => $model,
    'menuList' => $menuList,
    'structureList' => $structureList,
)); ?>