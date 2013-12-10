<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	  
		<?php
			$menuItems = array(
                array('label'=>'Главная', 'url'=>'/admin/start/index'),
				array('label'=>'Настройки', 'url'=>'/admin/settings'),
				array('label'=>'Разделы', 'url'=>'#', 'items' => array(
					array('label'=>'Пример', 'url'=>'#', 'items' => array(
						array('label'=>'Создать', 'url'=>"/admin/brands/create"),
						array('label'=>'Список', 'url'=>"/admin/brands/list"),
					)),
				)),
			);
		?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'color'=>'inverse', // null or 'inverse'
			'brandLabel'=> CHtml::encode(Yii::app()->name),
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'items'=>$menuItems,
				),
				array(
					'class'=>'bootstrap.widgets.TbNav',
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
				<?php $this->widget('bootstrap.widgets.TbNav', array(
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
