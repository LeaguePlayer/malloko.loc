
<?php $this->beginClip('r_sidebar'); ?>
	<section class="other_menu">
		<?php if ($othersMenu->totalItemCount != 0): ?>
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$othersMenu,
				'itemsCssClass'=>'items list-menu',
				'itemView'=>'_view',
				'template'=>'{items}',
			)); ?>
		<?php endif; ?>
	</section>
<?php $this->endClip(); ?>

<h1 class="title"><?php echo $model->name; ?></h1>
<div class="menu-date"><?php echo SiteHelper::russianDate($data->create_time); ?></div>

<?php echo $model->html_content; ?>
