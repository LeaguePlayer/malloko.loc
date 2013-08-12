<?php
/* @var $this EmployeesController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1 class="title">Наша команда</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'teams',
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
