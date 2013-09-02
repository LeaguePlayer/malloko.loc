<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<div class="well form-signin">
    <h2 class="form-signin-heading">Вход</h2>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
    )); ?>
        <?php echo $form->textFieldControlGroup($model, 'username', array('class'=>'span3')); ?>
        <?php echo $form->passwordFieldControlGroup($model, 'password', array('class'=>'span3')); ?>
        <?php echo $form->checkboxControlGroup($model, 'rememberMe'); ?>
        <?php echo TbHtml::submitButton('Войти'); ?>
    <?php $this->endWidget(); ?>
</div>