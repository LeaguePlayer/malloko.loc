
<div>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'separator'=>' → ',
        'links'=>$node->breadcrumbs,
    )); ?>
</div>


<div>
	<h1 class="news_title"><?= $node->name ?>
		<? if ( isset($_GET['tag']) && !empty($_GET['tag']) ): ?>
			<? echo ' по теме «'.$_GET['tag'].'»' ?>
			<a class="reset" href="<?= $this->createUrl($this->route, array('url'=>$_GET['url'])) ?>">Сбросить</a>
		<? endif ?>
	</h1>

	<? $tags = Tag::model()->findAll() ?>
	<div class="tags">
		<p>Выберите тему:</p>
		<ul>
			<? foreach ( $tags as $tag ): ?>
				<? $active = (isset($_GET['tag']) && $_GET['tag'] == $tag->value) ?>
				<li <?= $active ? 'class="active"' : '' ?>><a href="<?= $this->createUrl($this->route, array('url'=>$_GET['url'], 'tag'=>$tag->value)) ?>"><?= $tag->value ?></a></li>
			<? endforeach ?>
		</ul>
	</div>


	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}{pager}',
		'itemView'=>'_item',
	)) ?>
</div>