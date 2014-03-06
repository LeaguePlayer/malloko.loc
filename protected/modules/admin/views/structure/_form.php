<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'structure-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array(
            'label' => 'Параметры раздела',
            'content' => $this->renderPartial('_general_inputs', array(
                'form'=>$form,
                'model'=>$model,
                'parent'=>$parent
            ), true),
            'active' => true
        ),
        array(
            'label' => 'SEO',
            'content' => $this->getSeoForm($model),
        ),
    ),
)); ?>

<div class="form-actions">
    <?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
    <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/structure/list')); ?>
</div>

<?php $this->endWidget(); ?>
