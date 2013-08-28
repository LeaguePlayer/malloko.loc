
<section class="face">
	<h2>Лицо ресторана</h2>
	<div class="img_border">
		<div class="img_round">
			<a class="fancybox" title="<?php echo $model->fio; ?>" href="<?=$model->getImage();?>"><img src="<?php echo $model->getThumb('medium'); ?>" alt=""></a>
		</div>
	</div>
	<p class="name"><?=$model->fio?></p>
	<p class="post"><?=$model->position?></p>
</section>
