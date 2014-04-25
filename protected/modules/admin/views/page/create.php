<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list', 'opened' => $_GET['node_id']),
    'Создание',
);

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list', 'opened' => $_GET['node_id'])),
	array('label'=>'← Раздел', 'url'=>array('/admin/structure/update', 'id'=>$_GET['node_id'])),
);
?>

<h2>Новая страница</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>