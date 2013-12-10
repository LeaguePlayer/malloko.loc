	<?php echo $form->textFieldControlGroup($model,'label',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'type', Chtml::listData(SettingsTypes::getTypes(), 'type', 'name'), array(
		'id' => 'type'
	)); ?>

	<div id="value-block">
		<? $this->renderPartial('_'.($model->type ? $model->type : 'string'), array('model' => $settingType)); ?>
	</div>

	<?php //echo $form->textFieldControlGroup($model,'type_id',array('class'=>'span8')); ?>

