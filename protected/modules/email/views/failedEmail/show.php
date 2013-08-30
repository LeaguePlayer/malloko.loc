<h2>View FailedEmail <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo Html::link('Failed Email List',array('admin')); ?>]
[<?php echo Html::linkButton('Delete Failed Email',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo Html::encode($model->getAttributeLabel('to')); ?>
</th>
    <td><?php echo Html::encode($model->to); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo Html::encode($model->getAttributeLabel('subject')); ?>
</th>
    <td><?php echo Html::encode($model->subject); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo Html::encode($model->getAttributeLabel('serialize')); ?>
</th>
    <td><?php echo '<pre>'.Html::encode(print_r(unserialize($model->serialize), true)).'</pre>'; ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo Html::encode($model->getAttributeLabel('sent')); ?>
</th>
    <td><?php echo Html::encode($model->sent); ?>
</td>
</tr>
</table>
