<div class="item">
	<img src="<?php echo $data->getThumb('medium'); ?>" alt="">
	<p class="title"><?php echo $data->name; ?></p>
	<p class="date"><?php echo SiteHelper::russianDate($data->create_time); ?></p>
	<a href="<?php echo $data->viewUrl; ?>"></a>
</div>