<?php
$this->breadcrumbs=array(
	"Меню"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h3>Добавление пункта меню</h3>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'menuList' => $menuList,
    'structureList' => $structureList,
)); ?>