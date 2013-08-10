<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>

<div id="layout" class="fix-width">

	<section class="content col_2">
		<?php echo $content; ?>
	</section>


	<aside class="r_side">
		<?php echo $this->clips['r_sidebar'];?>
	</aside>
	<div class="clear"></div>
</div>

<?php $this->endContent(); ?>