<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php\n" ?>
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
<?php echo "?>\n" ?>

<h1>Управление <?php echo "<?php echo \$model->translition(); ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	echo $this->generateGridColumn($this->modelClass, $column);
}
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
