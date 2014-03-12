<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <?php
        if ( Yii::app()->user->hasFlash('PAGE_SAVED') ) {
            echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, Yii::app()->user->getFlash('PAGE_SAVED'));
        } else if ( $model->isNewRecord ) {
            echo TbHtml::alert(TbHtml::ALERT_COLOR_DANGER, 'Галерею можно будет добавить после сохранения текущего состояния страницы');
        }
    ?>

	<?php echo $form->errorSummary($model); ?>


    <div class='control-group'>
        <?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
        <?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
        <div class='img_preview'>
            <?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
            <span class='deletePhoto btn btn-danger btn-mini' data-modelname='Page' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
        </div>
        <?php echo $form->error($model, 'img_preview'); ?>
    </div>

    <?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span12','maxlength'=>255)); ?>

    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span12')); ?>

    <div class='control-group'>
        <?php echo CHtml::activeLabelEx($model, 'wswg_body'); ?>
        <?php $this->widget('appext.ckeditor.CKEditorWidget', array(
            'model' => $model,
            'attribute' => 'wswg_body',
            'config' => array(
                'width' => '100%'
            )
        )); ?>
        <?php echo $form->error($model, 'wswg_body'); ?>
    </div>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/page/list')); ?>
	</div>

<?php $this->endWidget(); ?>
