
<div class='control-group'>
    <?= TbHtml::label($model->label, "Config_{$model->id}_value") ?>
    <div class="controls">
        <?= $form->dropDownList($model, "[$model->id]value", $model->getVariants()); ?>
        <?= $form->error($model, "[$model->id]value"); ?>
    </div>
</div>