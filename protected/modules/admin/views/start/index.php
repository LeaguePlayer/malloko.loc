

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'layout'=>TbHtml::FORM_LAYOUT_INLINE,
	'enableAjaxValidation'=>false,
)); ?>

	<?php foreach ($settings as $setting): ?>
		<div class="control-group">
			<label class="control-label" for="<?=$setting->option?>"><?=$setting->label?></label>
			<div class="controls">
				<?php if ( $setting->type == 'select' ): ?>
					<?php echo TbHtml::dropDownList("Settings[{$setting->option}]", "{$setting->value}", unserialize($setting->ranges), array(
						'class'=>'span3',
						'displaySize'=>1,
						'empty'=>'Не задано',
					)); ?>
				<?php else: ?>
					<input class="span3" maxlength="256" name="Settings[<?=$setting->option?>]" id="<?=$setting->option?>" value="<?=$setting->value?>" type="text">
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Сброс',
		)); ?>
	</div>

<?php $this->endWidget(); ?>