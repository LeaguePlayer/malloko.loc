<div class="item bordered">
	<?php
		$dateArray = explode('.', date("d.m.Y", strtotime($data->public_date)));
		$month = SiteHelper::russianMonth($dateArray[1]);
	?>
	<div class="date"><strong><?php echo $dateArray[0]; ?></strong> <?php echo $month; ?></div>
	<div class="content">
		<div class="image">
			<a href="<?php echo $data->viewUrl(); ?>"><img src="<?php echo $data->getThumb('medium'); ?>" alt=""></a>
		</div>
		<div class="description">
			<h3><a href="<?php echo $data->viewUrl(); ?>"><?php echo $data->title; ?></a></h3>
			<div class="text">
				<p><?php echo $data->description; ?></p>
			</div>
		</div>
	</div>
</div>