<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'tabs' => array(
			array(
				'label' => 'Параметры страницы',
				'content' => $this->renderPartial('_rows', array(
					'form'=>$form,
					'model'=>$model,
					'parent'=>$parent
				), true),
				'active' => true
			),
			array(
				'label' => 'Галерея',
				'content' => $this->renderPartial('_gallery', array(
					'form' => $form,
					'model' => $model
				), true),
			),
		),
	)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/structure/list', 'opened'=>$_GET['node_id']))); ?>
		<?php $node_id = isset($_GET['node_id']) ? $_GET['node_id'] : $model->node->id ?>
		<?php if ( is_numeric($node_id) ) echo TbHtml::linkButton('← Раздел', array(
			'url'=>array('/admin/structure/update', 'id'=>$node_id)
		)); ?>
	</div>

<?php $this->endWidget(); ?>
