<?php
/* @var $this BannersController */
/* @var $dataProvider CActiveDataProvider */
?>
<?php $this->beginClip('r_sidebar'); ?>
	<?php $this->widget('application.extensions.face.FaceOfDayWidget'); ?>
<?php $this->endClip(); ?>

<h1 class="title">Реклама</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'list-banners stalactite',
	'itemView'=>'_view',
	//'afterAjaxUpdate'=>'alert(1);',
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
