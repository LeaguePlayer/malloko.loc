<?php
/* @var $this EventsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $type const */
?>

<?php if ($type == Events::TYPE_NEWS): ?>
<h1 class="title">Новости ресторана</h1>
<?php else: ?>
<h1 class="title">Светская хроника</h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>'{items}{pager}',
	'pager'=>array(
		'cssFile'=>false,
		'prevPageLabel'=>'',
		'nextPageLabel'=>'',
		'maxButtonCount'=>10,
		'header'=>false,
		'htmlOptions'=>array(
			'class'=>'pagination'
		)
	)
)); ?>
