<fieldset>
 
	<?php /*$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'seo-form',
		'enableAjaxValidation'=>false,
	)); */?>

		<?php //echo $form->errorSummary($model); ?>


		<?php echo TbHtml::activeTextFieldControlGroup($model,'meta_title',array('class'=>'span8','maxlength'=>255)); ?>

		<?php echo TbHtml::activeTextFieldControlGroup($model,'meta_keys',array('class'=>'span8','maxlength'=>255)); ?>

		<?php echo TbHtml::activeTextAreaControlGroup($model,'meta_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo TbHtml::activeTextAreaControlGroup($model,'meta_html',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?/*<div class="form-actions">
			<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/seo/list')); ?>
		</div>*/?>

	<?php /*$this->endWidget();*/ ?>
</fieldset>