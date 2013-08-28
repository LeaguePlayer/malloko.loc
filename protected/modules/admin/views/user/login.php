<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'form-signin'),
)); ?>

	<h2 class="form-signin-heading">Вход</h2>
	 
	<?php echo $form->textFieldControlGroup($model, 'username', array('class'=>'span3')); ?>
	<?php echo $form->passwordFieldControlGroup($model, 'password', array('class'=>'span3')); ?>
	<?php echo $form->checkboxControlGroup($model, 'rememberMe'); ?>
	<?php echo TbHtml::submitButton('Войти'); ?>
 
<?php $this->endWidget(); ?>