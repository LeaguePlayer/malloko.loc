<div class="item">

	<h3><?php echo $data->name; ?></h3>
	<div class="job-date"><?php echo SiteHelper::russianDate($data->create_time); ?></div>
	<?php echo $data->html_description; ?>

</div>