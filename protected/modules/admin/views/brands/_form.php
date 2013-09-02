<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'brands-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_timer'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_timer',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			)
		)); ?>
		<?php echo $form->error($model, 'dt_timer'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dttm_timer'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dttm_timer',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
			)
		)); ?>
		<?php echo $form->error($model, 'dttm_timer'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'tm_timer'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'tm_timer',
			'pluginOptions' => array(
				'format' => 'hh:mm',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickDate' => false
			)
		)); ?>
		<?php echo $form->error($model, 'tm_timer'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_sddd'); ?>
		<?php echo $form->fileField($model,'img_sddd', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_sddd) ) echo TbHtml::imageRounded( $model->imgBehaviorSddd->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Brands' data-attributename='Sddd' <?php if(empty($model->img_sddd)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_sddd'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_sdfsdf'); ?>
		<?php echo $form->fileField($model,'img_sdfsdf', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_sdfsdf) ) echo TbHtml::imageRounded( $model->imgBehaviorSdfsdf->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Brands' data-attributename='Sdfsdf' <?php if(empty($model->img_sdfsdf)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_sdfsdf'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_3434'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_3434',
		)); ?>
		<?php echo $form->error($model, 'wswg_3434'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_5656'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_5656',
		)); ?>
		<?php echo $form->error($model, 'wswg_5656'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_timer'); ?>
		<?php if ($model->galleryBehaviorTimer->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorTimer->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_dfdfdfdf'); ?>
		<?php if ($model->galleryBehaviorDfdfdfdf->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorDfdfdfdf->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Brands::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/brands/list')); ?>
	</div>

<?php $this->endWidget(); ?>
