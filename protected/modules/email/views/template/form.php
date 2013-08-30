<?php
$this->breadcrumbs=array(
    "Список шаблонов"=>array('list'),
    'Создание',
);

$this->menu=array(
    array('label'=>'Список','url'=>array('list')),
);
if (!$model->isNewRecord) {
    $this->menu[] = array('label'=>'Добавить','url'=>array('create'));
}
?>

<h1><?php echo $model->isNewRecord ? "Создание шаблона письма" : "Редактирование ".$model->name; ?></h1>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'templates-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>


    <?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>256)); ?>
    <?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8','maxlength'=>256)); ?>
    <?php echo $form->textFieldControlGroup($model,'subject',array('class'=>'span8','maxlength'=>256)); ?>

    <div class='control-group'>
        <?php echo CHtml::activeLabelEx($model, 'content'); ?>
        <?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'content',
        )); ?>
        <?php echo $form->error($model, 'wswg_3434'); ?>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
