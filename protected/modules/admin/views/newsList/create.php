<?php
$this->breadcrumbs=array(
	"Структура сайта"=>array('/admin/structure/list'),
	'Создание',
);

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
);
?>

<h1>Новости</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>