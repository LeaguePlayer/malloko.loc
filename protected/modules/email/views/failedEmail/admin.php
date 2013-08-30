<h2>Failed Emails</h2>
<div class="actionBar">
[<?php echo Html::link('Attempt to resend failed emails',array('sendFailedEmails')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $sort->link('id'); ?></th>
    <th><?php echo $sort->link('to'); ?></th>
    <th><?php echo $sort->link('subject'); ?></th>
    <th><?php echo $sort->link('sent'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo Html::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo Html::encode($model->to); ?></td>
    <td><?php echo Html::encode($model->subject); ?></td>
    <td><?php echo Html::encode($model->sent); ?></td>
    <td>
      <?php echo Html::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"Are you sure to delete #{$model->id}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>