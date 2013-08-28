<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'brands-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_1'); ?>
		<?php echo $form->fileField($model,'img_1', array('class'=>'span3')); ?><?php echo $model->imgBehavior1->getImage('small'); ?>
		<?php echo $form->error($model, 'img_1'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_2'); ?>
		<?php echo $form->fileField($model,'img_2', array('class'=>'span3')); ?><?php echo $model->imgBehavior2->getImage('small'); ?>
		<?php echo $form->error($model, 'img_2'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_slides'); ?>
		<?php if ($model->galleryBehaviorSlides->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('admin_ext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorSlides->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_thumbs'); ?>
		<?php if ($model->galleryBehaviorThumbs->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('admin_ext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorThumbs->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dttm_datetime'); ?>
		<?php $this->widget('admin.extensions.yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dttm_datetime',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
			)
		)); ?>
		<?php echo $form->error($model, 'dttm_datetime'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_date'); ?>
		<?php $this->widget('admin.extensions.yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_date',
			'pluginOptions' => array(
				'format' => 'MM-dd-yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			)
		)); ?>
		<?php echo $form->error($model, 'dt_date'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'tm_time'); ?>
		<?php $this->widget('admin.extensions.yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'tm_time',
			'pluginOptions' => array(
				'format' => 'hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickDate' => false
			)
		)); ?>
		<?php echo $form->error($model, 'tm_time'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dttm_datetime2'); ?>
		<?php $this->widget('admin.extensions.yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dttm_datetime2',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
			)
		)); ?>
		<?php echo $form->error($model, 'dttm_datetime2'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_content'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_content',
		)); ?>
		<?php echo $form->error($model, 'wswg_content'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_description'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_description',
		)); ?>
		<?php echo $form->error($model, 'wswg_description'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'msk_field',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'msk_field2',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Brands::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
