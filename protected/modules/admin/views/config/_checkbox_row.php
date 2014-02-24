
<div class='control-group'>
    <div class="controls">
        <?= TbHtml::openTag('label', array('class' => 'checkbox')) ?>
            <?= $form->checkBox($model, "[$model->id]value"); ?>
            <?= $model->label ?>
        <?= TbHtml::closeTag('label') ?>
        <?= $form->error($model, "[$model->id]value"); ?>
    </div>
</div>