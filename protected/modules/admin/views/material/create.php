<?php
$this->breadcrumbs=array(
	"Список материалов"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список материалов','url'=>array('list')),
);
?>

<h1>Добавление материала</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>