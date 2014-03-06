<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->config->get('app.name')).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

        <?php
            $menuItems = array(
                array('label'=>'Разделы сайта', 'url'=>array('/admin/structure')),
                array('label'=>'Меню сайта', 'url'=>array('/admin/menu')),
                array('label'=>'Материалы', 'url'=>array('/admin/material')),
                array('label'=>'Настройки', 'url'=>array('/admin/config')),
            );
        ?>
        <?php
            $userlogin = Yii::app()->user->name ? Yii::app()->user->name : Yii::app()->user->email;
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'color'=>'inverse', // null or 'inverse'
                'brandLabel'=> CHtml::encode(Yii::app()->name),
                'brandUrl'=>'/',
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
                            array('label'=>'Выйти ('.$userlogin.')', 'url'=>'/user/logout'),
                        ),
                    ),
                ),
            ));
        ?>

        <?php echo $content;?>

	</body>
</html>
