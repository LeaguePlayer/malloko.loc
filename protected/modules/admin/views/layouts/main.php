<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	  
		<?php
			/*
			$menuItems = array();
			foreach (SiteHelper::scanNameModels() as $modelClass) {
				$controllerId = strtolower($modelClass);
				$menuItems[] = array('label'=>$modelClass, 'url'=>'#', 'items' => array(
					array('label'=>'Создать', 'url'=>"/admin/{$controllerId}/create"),
					array('label'=>'Список', 'url'=>"/admin/{$controllerId}/list"),
				));
			}
			 */
			$menuItems = array(
				array('label'=>'Сотрудники', 'url'=>'#', 'items' => array(
					array('label'=>'Создать', 'url'=>"/admin/employees/create"),
					array('label'=>'Список', 'url'=>"/admin/employees/list"),
				)),
				array('label'=>'Новости', 'url'=>'#', 'items' => array(
					array('label'=>'Создать', 'url'=>"/admin/events/create"),
					array('label'=>'Список', 'url'=>"/admin/events/list"),
				)),
				array('label'=>'Рестораны', 'url'=>'#', 'items' => array(
					array('label'=>'Создать', 'url'=>"/admin/places/create"),
					array('label'=>'Список', 'url'=>"/admin/places/list"),
				)),
				array('label'=>'Слайдер', 'url'=>'#', 'items' => array(
					array('label'=>'Создать', 'url'=>"/admin/slider/create"),
					array('label'=>'Список', 'url'=>"/admin/slider/list"),
				)),
			)
		?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'color'=>'inverse', // null or 'inverse'
			'brandLabel'=> CHtml::encode(Yii::app()->name),
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'items'=>$menuItems,
				),
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items'=>array(
						array('label'=>'Выйти', 'url'=>'/admin/user/logout'),
					),
				),
			),
		)); ?>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span1">
				<?php $this->widget('bootstrap.widgets.TbMenu', array(
					'type'=>'list',
					'items'=> $this->menu
					)); ?>
				</div>
				<div class="span11">
					<?php echo $content;?>
				</div>
			</div>
		</div>

	</body>
</html>
