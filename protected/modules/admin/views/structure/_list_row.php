<?php
	// Формирую текст с необходимым количесвтом отступов в зависимости от уровня вложенности
	$name_text = str_repeat('<span class="offset"></span>', $node->level - 1);
	if ( $isOpen ) {
		$expand_button = TbHtml::link(TbHtml::icon(TbHtml::ICON_MINUS), '#', array('class'=>'expand-button open'));
	} else {
		$expand_button = TbHtml::link(TbHtml::icon(TbHtml::ICON_PLUS), '#', array('class'=>'expand-button'));
	}

	if ( !$node->isRoot() && !$node->isLeaf() ) {
		$name_text .= $expand_button;
	}
	$name_text .= CHtml::link($node->name, array('updateMaterial',"node_id"=>$node->id));

	// Ссылка на компонент
	$component_url = $node->getUrl() ?
		CHtml::link($node->getUrl(), $node->getUrl(), array("target"=>"_blank")) :
		'<em>Компонент не привязан</em>';

	// Пункты для выпадающего меню
	$menu_items = array(
		array('label' => '<b>Открыть</b>', 'url' => array('/admin/structure/updateMaterial', 'node_id'=>$node->id)),
		array('label' => 'Свойства раздела', 'url' => array('/admin/structure/update/', 'id'=>$node->id)),
		array('label' => 'Добавить подраздел', 'url' => array('/admin/structure/create/', 'parent_id'=>$node->id)),
	);
	if ( !$node->isRoot() ) {
		$menu_items[] = array('label' => 'Удалить раздел', 'url' => array('/admin/structure/delete', 'id'=>$node->id), 'linkOptions' => array('class'=>'delete-node'));
	}
?>

<div class='row' data-id='<?= $node->id ?>'>
	<span class='cell check'><? if ( !$node->isRoot() ) echo CHtml::checkBox('') ?></span>
	<span class='cell menu'>
		<?php echo TbHtml::buttonDropdown(TbHtml::icon(TbHtml::ICON_TH_LIST), $menu_items, array(
			'size'=>TbHtml::BUTTON_SIZE_MINI
		)); ?>
	</span>
	<span class='cell name'><?= $name_text ?></span>
	<span class='cell link'><?= $component_url ?></span>
	<span class='cell type'><?= $node->material->name ?></span>
</div>