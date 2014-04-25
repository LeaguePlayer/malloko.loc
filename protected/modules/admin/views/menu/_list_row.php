<?php
	// Пункты меню
	$menu_items = array(
		array("label" => "<b>Свойства</b>", "url" => array("/admin/menu/update", "id"=>$node->id)),
		array("label" => "Добавить подпункт", "url" => array("/admin/menu/create", "parent_id"=>$node->id), "visible" => $node->level<3),
		array("label" => "Удалить", "url" => array("/admin/menu/delete", "id"=>$node->id), "visible" => !$node->isRoot(), 'linkOptions' => array('class'=>'delete-node')),
	);

	if ( $node->isRoot() ) {
		$url = '';
	} else {
		// Ссылка на компонент
		$url = $node->getUrl() ?
			CHtml::link($node->getUrl(), $node->getUrl(), array("target"=>"_blank")) :
			'<em>Не задано</em>';
	}

	$node_name = str_repeat('<span class="offset"></span>', $node->level - 1);
	$node_name .= ( $node->level == 2 ? "<b>{$node->name}</b>" : $node->name );
?>
<div class='row' data-id='<?= $node->id ?>'>
	<span class='cell check'><?php if ( !$node->isRoot() ) echo CHtml::checkBox('') ?></span>
	<span class='cell menu'>
		<?= TbHtml::buttonDropdown(TbHtml::icon(TbHtml::ICON_TH_LIST), $menu_items, array(
			"size"=>TbHtml::BUTTON_SIZE_MINI
		)); ?>
	</span>
	<span class='cell name'><?= $node_name ?></span>
	<span class='cell link'><?= $url ?></span>
	<span class='cell type'><?= Menu::getStatusAliases($node->status) ?></span>
</div>