<?php $this->beginContent('/layouts/main'); ?>
<div class="span12" id="main-content">
	<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	    'links'=>$this->breadcrumbs,
	    'homeLink'=>CHtml::link('Главная',array('/admin')),
	)); ?>
    <?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>