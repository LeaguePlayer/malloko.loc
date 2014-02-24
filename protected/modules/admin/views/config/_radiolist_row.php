<div class='control-group'>
    <?= TbHtml::label($model->label, "Config_{$model->id}_value", array('class'=>'control-label')) ?>
    <div class="controls">
        <?= $form->radioButtonList($model, "[$model->id]value", $model->getVariants()); ?>
    </div>
    <?= $form->error($model, "[$model->id]value"); ?>
</div>