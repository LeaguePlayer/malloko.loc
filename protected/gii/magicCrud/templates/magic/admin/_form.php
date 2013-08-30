<?php
/**
 * The following variables are available in this template:
 * - $this: the MagicCrudCode object
 */
if ( $this->existUploadableColumns() ) {
	$formCodePart = "\n\t\t'htmlOptions' => array('enctype'=>'multipart/form-data'),";
}
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,".$formCodePart."
)); ?>\n"; ?>

<?php echo "\t<?php echo \$form->errorSummary(\$model); ?>\n\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
	if ($column->name === 'create_time' or $column->name === 'update_time')
		continue;
	if ($column->name === 'sort')
		continue;
?>
	<?php echo $this->generateActiveRow($this->modelClass,$column); ?>

<?php
}
?>
	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
