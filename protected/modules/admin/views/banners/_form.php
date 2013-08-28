<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'banners-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'image'); ?>
		<?php echo TbHtml::imageRounded($model->getThumb('medium')); ?><br>
		<?php echo $form->fileField($model,'image', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'link',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'target_method', Banners::getTargetMethodLabels(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>256)); ?>

	<?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'place_id', CHtml::listData(Places::model()->findAll(), 'id', 'title'), array(
		'class'=>'span8',
		'displaySize'=>1,
		'empty'=>'Не задано'
	)); ?>
	<?php echo $form->dropDownListControlGroup($model, 'status', Banners::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
