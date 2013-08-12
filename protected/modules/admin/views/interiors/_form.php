<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'interiors-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'place_id', CHtml::listData(Places::model()->findAll(), 'id', 'title'), array('class'=>'span8', 'displaySize'=>1)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gallery'); ?>
		<?php if ($model->galleryManager->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('admin_ext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryManager->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Interiors::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
