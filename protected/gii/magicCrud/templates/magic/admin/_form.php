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
		<?php echo "<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>"; ?>
        <?php echo "<?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/".strtolower($this->modelClass)."/list')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
