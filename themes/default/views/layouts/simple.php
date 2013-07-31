<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="center" style="min-height: 500px;">
	<?php echo $this->getClip('main_menu');?>
	<?php echo $content; ?>
</section>
<?php $this->endContent(); ?>