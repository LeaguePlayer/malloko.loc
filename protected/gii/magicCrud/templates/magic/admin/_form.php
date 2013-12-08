<?php
/**
 * The following variables are available in this template:
 * - $this: the MagicCrudCode object
 */
$formCodePart = "";
$allColumns = $this->tableSchema->columns;

if ( $this->existUploadableColumns() ) {
	$formCodePart = "\n\t\t'htmlOptions' => array('enctype'=>'multipart/form-data'),";
}
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,".$formCodePart."
)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

	<?php
	echo "<?php \$tabs = array(); ?>\n\t";
	echo "<?php \$tabs[] = array('label' => 'Основные данные', 'content' => \$this->renderPartial('_rows', array('form'=>\$form, 'model' => \$model), true), 'active' => true); ?>\n";
	?>
	<?php //add Seo Tab
	if(isset($allColumns['seo_id']))
		echo "<?php \$tabs[] = array('label' => 'SEO раздел', 'content' => \$this->getSeoForm(\$model)); ?>\n";?>

	<?php echo "<?php \$this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => \$tabs)); ?>\n"; ?>

	<div class="form-actions">
		<?php echo "<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>\n"; ?>
        <?php echo "<?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/".strtolower($this->modelClass)."/list')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
