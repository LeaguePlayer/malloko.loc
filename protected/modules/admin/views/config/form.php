
<?php
$this->breadcrumbs=array(
    'Настройки',
); ?>

<h2>Настройки сайта</h2>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php if ( Yii::app()->user->hasFlash('CONFIG_SUCCESS') ): ?>
        <div class="alert alert-success"><?= Yii::app()->user->getFlash('CONFIG_SUCCESS') ?></div>
    <?php endif ?>

    <?php
        foreach ( $confArray as $counter => $config ) {
            $row_name = $config->type ? '_'.$config->type.'_row' : '_string_row';
            echo $this->renderPartial($row_name, array(
                'form' => $form,
                'counter' => $counter,
                'model' => $config
            ));
        }
    ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/settings/list')); ?>
    </div>

<? Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/settings.js'); ?>
<?php $this->endWidget(); ?>