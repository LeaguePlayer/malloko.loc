<?php
/* @var $this EventsController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="topics chronic">
	<a href="<?php echo Events::getChroniclesUrl(); ?>" class="action">Все светские новости</a>
	<h2 class="caption">Светская хроника</h2>
	<div class="clear"></div>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_event_view',
		'template'=>'{items}',
	)); ?>
</div>