
<a title="<?php echo $model->title; ?>" href="<?php echo $model->link; ?>" <?php if ($model->target_method == Banners::TARGET_BLANK) echo "target='_blank'"; ?>><img src="<?php echo $model->getThumb('medium'); ?>" alt="<?php echo $model->title; ?>"></a>
