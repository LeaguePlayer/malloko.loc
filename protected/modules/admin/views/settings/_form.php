<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array(
			'form'=>$form, 
			'model' => $model, 
			'settingType' => $settingType),
		true), 
	'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/settings/list')); ?>
	</div>
	<? Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/settings.js'); ?>
<?php $this->endWidget(); ?>
