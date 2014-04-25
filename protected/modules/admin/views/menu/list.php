<h3>Меню сайта</h3>

<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/menu.list.js', CClientScript::POS_END); ?>

<div class="actions">
    <?php
        echo TbHtml::buttonGroup(array(
            array(
                'label'=>'Переместить вниз',
                'icon'=>TbHtml::ICON_ARROW_DOWN,
                'url'=>'/admin/menu/moveDown',
                'class'=>'down',
                'disabled'=>true
            ),
            array(
                'label'=>'Переместить вверх',
                'icon'=>TbHtml::ICON_ARROW_UP,
                'url'=>'/admin/menu/moveUp',
                'class'=>'up',
                'disabled'=>true
            ),
        ));
    ?>
</div>

<?php $rootNode = Menu::model()->roots()->find(); ?>
<div id="structure-grid">
    <?php if ( $rootNode ): ?>
        <ul class="root">
            <li>
                <div class='head row'>
                    <span class='cell check'></span>
                    <span class='cell menu'></span>
                    <span class='cell name'><b>Название</b></span>
                    <span class='cell link'><b>Ссылка</b></span>
                    <span class='cell type'><b>Включено</b></span>
                </div>
            </li>
            <li><?= $this->renderPartial('_list_row', array('node' => $rootNode)) ?>
                <?php
                    $descendants = $rootNode->descendants()->findAll();
                    $lastLevel = $rootNode->level;
                ?>
                <?php if ( count($descendants) ): ?>
                <ul>
                    <?php foreach ( $descendants as $node ): ?>
                        <?php if ( $node->level < $lastLevel ) {
                            echo str_repeat('</ul></li>', $lastLevel - $node->level);
                        } ?>
                        <?php $lastLevel = $node->level ?>

						<li>
							<?php echo $this->renderPartial('_list_row', array('node' => $node)) ?>
							<?php if ( !$node->isLeaf() ): ?>
								<ul>
							<?php endif ?>
						</li>
                    <?php endforeach ?>
                        </ul>
                <?php endif ?>
            </li>
        </ul>
    <?php endif ?>
</div>