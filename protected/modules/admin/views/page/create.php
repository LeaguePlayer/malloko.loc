<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list'),
    'Создание',
);


$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
);
if ( is_numeric($_GET['node_id']) ) {
    $this->menu[] = array('label'=>'← К разделу', 'url'=>array('/admin/structure/update', 'id' => $_GET['node_id']));
}

?>

<h2>Новая стрница</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>