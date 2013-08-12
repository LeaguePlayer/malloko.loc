
<div class="item">
	<a title="<?php echo $data->description; ?>" href="<?php echo $data->site; ?>" <?php if (!empty($data->site)) echo "target='_blank'"; ?>><img src="<?php echo $data->getThumb('medium'); ?>" alt="<?php echo $data->name; ?>"></a>
</div>