<?php
/* @var $this EventsController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="topics chronic">
	<a href="<?php echo $this->createUrl('events/index', array('type' => Events::TYPE_CHRONICLE)); ?>" class="action">Все светские новости</a>
	<h2 class="caption">Светские хроники</h2>
	<div class="clear"></div>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_event_view',
		'template'=>'{items}',
	)); ?>
</div>