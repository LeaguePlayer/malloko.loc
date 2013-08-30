<?php
$this->menu=array(
    array('label'=>'Добавить','url'=>array('create')),
);
?>

    <h1>Управление шаблонами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'email_templates-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'type'=>TbHtml::GRID_TYPE_HOVER,
    'columns'=>array(
        'name',
        'alias',
        'subject',
        array(
            'name'=>'create_time',
            'type'=>'raw',
            'value'=>'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', $data->create_time)'
        ),
        array(
            'name'=>'update_time',
            'type'=>'raw',
            'value'=>'SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', $data->update_time)'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>