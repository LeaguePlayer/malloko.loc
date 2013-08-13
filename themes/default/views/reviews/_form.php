
<div class="form">

    <h2>Оставьте Ваш отзыв</h2>
    
    <?php if (Yii::app()->user->hasFlash('SUCCESS_REVIEW')): ?>
    	<div class="successMessage"><?php echo Yii::app()->user->getFlash('SUCCESS_REVIEW'); ?></div>
    	<?php Yii::app()->end(); ?>
    <?php endif; ?>
		
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'review-form',
		'enableClientValidation'=>false,
	)); ?>

		<div class="row">
			<?php echo $form->label($model, 'name'); ?>
			<?php echo $form->textField($model, 'name', array(
				'placeholder' => 'Укажите Ваше имя',
			)); ?>
			<?php echo $form->error($model, 'name'); ?>
		</div>

		<div class="row">
			<?php echo $form->label($model, 'description'); ?>
			<?php echo $form->textArea($model, 'description', array(
				'placeholder' => 'Ваш отзыв',
				'class' => 'custom'
			)); ?>
			<?php echo $form->error($model, 'description'); ?>
		</div>

		<div class="button-row">
			<button class="custom-button" type="submit">Оставить отзыв</button>
		</div>

	<?php $this->endWidget(); ?>
</div>
