<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<section class="center" style="min-height: 500px;">
	<nav>
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => $this->menu
		)) ?>
	</nav>

	<?php echo $content; ?>
</section>
<?php $this->endContent(); ?>