<div class="item">
	<?
		$url = $data->getUrl();
		$delimiter = '?';
		if ( isset($_GET['News_page']) ) {
			$url .= $delimiter.'newsPage='.$_GET['News_page'];
			$delimiter = '&';
		}
		if ( isset($_GET['tag']) )
			$url .= $delimiter.'tag='.$_GET['tag'];
	?>

    <h2 class="title"><a href="<?= $url ?>"><?= $data->title ?></a></h2>

	<? if ( $data->tags ): ?>
		<? $tags = explode(',', $data->tags) ?>
		<div class="tags mini">
			<ul>
				<li class="label">Темы:</li>
				<? foreach ( $tags as $tag ): ?>
					<li><a href="<?= $this->createUrl($this->route, array('url'=>$_GET['url'], 'tag'=>$tag)) ?>"><?= $tag ?></a></li>
				<? endforeach ?>
			</ul>
		</div>
	<? endif ?>

	<?php if ( !empty($data->img_preview) ): ?>
        <a href="<?= $url ?>"><img src="<?= $data->getImageUrl('small') ?>" alt=""/></a>
    <?php endif ?>
    <div class="description">
        <p class="text"><?= $data->short_description ?></p>
        <? $linkText = $node->url === 'news' ? 'Читать' : 'Подробнее' ?>
        <a href="<?= $url ?>"><?= $linkText ?></a>
    </div>
</div>