<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php
        $htmlOptions = array(
            'class'=>'span8'
        );
        if ( $model->isRoot() ) {
            $htmlOptions['disabled'] = 'disabled';
            $htmlOptions['empty'] = 'Не задано';
        }
        echo $form->dropDownListControlGroup($model,'parent_id', $menuList, $htmlOptions);
    ?>

    <?php echo $form->dropDownListControlGroup($model,'node_id', $structureList, array(
        'class'=>'span8',
        'empty' => 'Не задано'
    )); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'external_link',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'item_class',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->checkBoxControlGroup($model, 'status'); ?>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/menu/list')); ?>
	</div>

<?php $this->endWidget(); ?>
