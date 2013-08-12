<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'partners-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'image'); ?>
		<?php echo TbHtml::imageRounded($model->getThumb('medium')); ?><br>
		<?php echo $form->fileField($model,'image', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->textAreaControlGroup($model,'description',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->textFieldControlGroup($model,'site',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Partners::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
