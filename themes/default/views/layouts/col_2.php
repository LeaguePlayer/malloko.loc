<?php /* @var $this Controller */ ?>


<?php if ( !isset($this->clips['r_sidebar']) ): ?>
	<?php $this->beginClip('r_sidebar'); ?>
		<?php $this->widget('application.extensions.banner.BannerWidget'); ?>
		<?php $this->widget('application.extensions.face.FaceOfDayWidget'); ?>
	<?php $this->endClip(); ?>
<?php endif; ?>



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