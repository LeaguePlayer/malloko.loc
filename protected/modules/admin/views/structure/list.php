<?php
    Yii::app()->clientScript->registerScriptFile( $this->getAssetsUrl().'/js/structure.list.js', CClientScript::POS_END );
?>

<h2>Структура сайта</h2>

<div class="actions">
    <?php
    echo TbHtml::buttonGroup(array(
        array(
            'label'=>'Переместить вниз',
            'icon'=>TbHtml::ICON_ARROW_DOWN,
            'url'=>'/admin/structure/moveDown',
            'class'=>'down',
            'disabled'=>true
        ),
        array(
            'label'=>'Переместить вверх',
            'icon'=>TbHtml::ICON_ARROW_UP,
            'url'=>'/admin/structure/moveUp',
            'class'=>'up',
            'disabled'=>true
        ),
        array(
            'label'=>'Переместить внутрь следующего узла',
            'icon'=>TbHtml::ICON_ARROW_RIGHT,
            'url'=>'/admin/structure/moveToNext',
            'class'=>'to_next',
            'disabled'=>true
        ),
        array(
            'label'=>'Переместить на уровень выше',
            'icon'=>TbHtml::ICON_ARROW_LEFT,
            'url'=>'/admin/structure/moveToParent',
            'class'=>'to_parent',
            'disabled'=>true
        ),
    ));
    ?>
</div>

<?php $rootNode = Structure::model()->roots()->find(); ?>
<div id="structure-grid">
    <?php if ( $rootNode ): ?>
        <ul class="root">
            <li>
                <div class='head row'>
                    <span class='cell check'></span>
                    <span class='cell menu'></span>
                    <span class='cell name'><b>Раздел</b></span>
                    <span class='cell link'><b>Ссылка</b></span>
                    <span class='cell type'><b>Тип</b></span>
                </div>
            </li>
            <li><?php echo $rootNode->renderAdminRow() ?>
                <?php
                    $descendants = $rootNode->descendants()->findAll();
                    $lastLevel = $rootNode->level;
                ?>
                <? if ( count($descendants) ): ?>
                    <ul>
                        <? foreach ( $descendants as $node ): ?>
                            <?php if ( $node->level < $lastLevel ) {
                                echo str_repeat('</ul></li>', $lastLevel - $node->level);
                            } ?>
                            <?php $lastLevel = $node->level ?>
                            <?php if ( $node->isLeaf() ): ?>
                                <li><? $node->renderAdminRow() ?></li>
                            <?php else: ?>
                                <li><? $node->renderAdminRow() ?><ul style="display: none;">
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </li>
        </ul>
    <?php endif ?>
</div>