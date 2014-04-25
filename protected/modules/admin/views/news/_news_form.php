<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile($this->getAssetsUrl().'/css/bootstrap.tagsinput.css');
$cs->registerScriptFile($this->getAssetsUrl().'/js/bootstrap.tagsinput.js', CClientScript::POS_END);


$tags = Tag::model()->findAll();
foreach ( $tags as $tag ) {
	$source[] = $tag->value;
}
$source = CJSON::encode($source);

$js_tagsinput = <<< EOT
	$(document).ready(function() {
		$('#News_tags').tagsinput({
			typeahead: {
				source: $source,
				minLength: 0,
			}
		});
	});
EOT;

$cs->registerScript('tagsinput', $js_tagsinput);
?>


<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span12','maxlength'=>255)); ?>

<?php echo $form->textFieldControlGroup($model,'tags',array('maxlength'=>255, 'style'=>'width:100%')); ?>


<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
	<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
	<div class='img_preview'>
		<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
		<span class='deletePhoto btn btn-danger btn-mini' data-modelname='News' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
	</div>
	<?php echo $form->error($model, 'img_preview'); ?>
</div>

<?php echo $form->textAreaControlGroup($model, 'short_description', array('class'=>'span12', 'rows'=>6)) ?>

<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'body_content'); ?>
	<?php $this->widget('appext.ckeditor.CKEditorWidget', array(
		'model' => $model,
		'attribute' => 'body_content',
		'config' => array(
			'width' => '99%'
		)
	)); ?>
	<?php echo $form->error($model, 'body_content'); ?>
</div>

<?php echo $form->dropDownListControlGroup($model, 'status', News::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>