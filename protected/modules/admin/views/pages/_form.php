<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pages-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>256)); ?>
	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8','maxlength'=>256)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'html_content'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array(
			'model' => $model,
			'attribute' => 'html_content',
			'config' => array(
				'toolbar'=>'standard',
			),
		)); ?>
		<?php echo $form->error($model, 'html_content'); ?>
	</div>

	<?php //echo $form->dropDownListControlGroup($model, 'place_id', CHtml::listData(Places::model()->findAll(), 'id', 'title'), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Pages::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
		
		<?php if ( !$model->isNewRecord ): ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'Посмотреть',
				'url'=>$model->viewUrl,
				'htmlOptions'=>array('class'=>'f-iframe', 'data-fancybox-type'=>'iframe')
			)); ?>
		<?php endif; ?>
	</div>

<?php $this->endWidget(); ?>
