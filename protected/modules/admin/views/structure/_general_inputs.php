<?php

$js = <<< EOT
	$(document).ready(function() {
		var alias_input = $('#Structure_url');
		$('#Structure_name').keyup(function(e) {
			alias_input.val( transliterate($(this).val()) );
		});

		$('#Structure_name').change(function(e) {
			alias_input.val( transliterate($(this).val()) );
		});
	});
EOT;
Yii::app()->clientScript->registerScript('STRUCTURE_FORM', $js);

?>



<?= $form->textFieldControlGroup($model, 'name',array('class'=>'span12','maxlength'=>255)); ?>

<?php
//    $prependText = $parent ? strtr($parent->url.'/', array('/' => ' / ')) : ' / ';
?>
<?= $form->textFieldControlGroup($model, 'url',array('class'=>'span12','maxlength'=>255, 'prepend' => $prependText)); ?>

<?php //if($model->parent_id != 0) //main page
//    echo $form->dropDownListControlGroup($model, 'parent_id', $model->getTreeListData(), array('class'=>'span6')); ?>

<?= $form->dropDownListControlGroup($model, 'material_id', CHtml::listData(Material::model()->findAll(), 'id', 'name'), array('class'=>'span12', 'empty'=>'Выберите тип раздела')); ?>

<?= $form->dropDownListControlGroup($model, 'status', Structure::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>