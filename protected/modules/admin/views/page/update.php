<?php
$this->breadcrumbs=array(
    "Структура сайта"=>array('/admin/structure/list'),
    'Редактирование',
);

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
    array('label'=>'Добавить новую','url'=>array('create', 'node_id'=>$model->node->id)),
);
if ( $model->node ) {
    $this->menu[] = array('label'=>'← К разделу', 'url'=>array('/admin/structure/update', 'id' => $model->node->id));
}

?>

<h2><?php echo $model->node->name; ?></h2>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>