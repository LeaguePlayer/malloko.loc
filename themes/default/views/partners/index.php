<?php
/* @var $this PartnersController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1 class="title">Наши партнеры</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'partners-list stalactite',
	'itemView'=>'_view',
	'template'=>'{items}',
)); ?>
