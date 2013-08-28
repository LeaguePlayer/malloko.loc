<?php $this->beginClip('main_menu'); ?>
<nav id="main-menu">
<?php 

$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Главная', 'url'=>array('/site/index')),
	),
)); ?>
</nav>
<?php $this->endClip(); ?>