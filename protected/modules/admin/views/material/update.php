<?php
$this->breadcrumbs=array(
	"Список материалов"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список материалов', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Редактирование материала</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>