<?php
$this->cs->registerCssFile($this->getAssetsUrl().'/css/style.css');

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
    <?php echo $form->textFieldControlGroup($model,'from',array('class'=>'span8','maxlength'=>256)); ?>

    <div id="email_variables_list" class="control-group well">
        <?php echo CHtml::label('Доступные перменные', ''); ?>
        <p class="text-info"><small>Все вхождения вида  [[ИМЯ_ПЕРЕМЕННОЙ]]  будут заменены соответствующим ЗНАЧЕНИЕМ ПЕРЕМЕННОЙ</small></p>
        <?php foreach ($variables as $variable): ?>
            <div>
                <span class="name"><?= $variable->name; ?></span><span class="value"><?= $variable->value; ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class='control-group'>
        <?php echo CHtml::activeLabelEx($model, 'content'); ?>
        <?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'content',
        )); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <?php echo $form->textFieldControlGroup($model,'send_interval',array('class'=>'span8','maxlength'=>256)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Сохранить',
        )); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/email/template/list')); ?>
    </div>

<?php $this->endWidget(); ?>
