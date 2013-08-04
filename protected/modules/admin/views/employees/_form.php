<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'employees-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'image'); ?>
		<?php echo TbHtml::imageRounded($model->getThumb('medium')); ?><br>
		<?php echo $form->fileField($model,'image', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->textFieldControlGroup($model,'position',array('class'=>'span8','maxlength'=>256)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'html_quote'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'html_quote',
		)); ?>
		<?php echo $form->error($model, 'html_quote'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Employees::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<?php echo $form->textFieldControlGroup($model,'sort',array('class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
