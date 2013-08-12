


<div class="item">
	<h3><?php echo $data->title; ?></h3>
	<a title="<?php echo $data->title; ?>" href="<?php echo $data->link; ?>" <?php if ($data->target_method == Banners::TARGET_BLANK) echo "target='_blank'"; ?>><img src="<?php echo $data->getThumb('medium'); ?>" alt="<?php echo $data->title; ?>"></a>
	<p><?php echo $data->description; ?></p>
</div>