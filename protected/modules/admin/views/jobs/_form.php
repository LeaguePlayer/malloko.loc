<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'jobs-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>256)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'html_description'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'html_description',
		)); ?>
		<?php echo $form->error($model, 'html_description'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Jobs::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
