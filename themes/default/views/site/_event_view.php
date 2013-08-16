<div class="item">
	<?php
		$dateArray = explode('.', date("d.m.Y", strtotime($data->public_date)));
		$month = SiteHelper::russianMonth($dateArray[1]);
	?>
	<div class="date"><strong><?php echo $dateArray[0]; ?></strong> <?php echo $month; ?></div>
	<div class="event-content">
		<img src="<?php echo $data->getThumb('medium'); ?>" alt="">
		<p class="title"><?php echo $data->title; ?></p>
		<p><?php echo $data->description; ?></p>
		<a href="<?php echo $data->viewUrl(); ?>"></a>
	</div>
</div>