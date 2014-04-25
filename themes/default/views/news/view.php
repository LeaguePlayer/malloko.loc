
<div>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'separator'=>' → ',
        'links'=>$this->breadcrumbs,
    )); ?>
</div>

<div class="width_980">
	<h1 class="news_title"><?= $model->title ?></h1>

	<?php if ( !empty($model->img_preview) ): ?>
		<img class="preview" src="<?= $model->getImageUrl('big') ?>" alt=""/>
	<?php endif ?>

	<?= $model->body_content ?>

	<? if ( !empty($model->tags) ): ?>
		<? $tags = explode(',', $model->tags) ?>
		<div class="tags mini">
			<ul>
				<li class="label">Темы</li>
				<? foreach ( $tags as $tag ): ?>
					<?php if ( empty($tag) ) continue ?>
					<li><a href="<?= $node->getUrl(array('tag'=>$tag)) ?>"><?= $tag ?></a></li>
				<? endforeach ?>
			</ul>
		</div>
	<? endif ?>

	<div class="back">
		<a href="<?= $node->getUrl().'?News_page='.$newsPage.'&tag='.$_GET['tag'] ?>">← Вернуться назад</a>
	</div>
</div>