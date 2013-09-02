<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode(Yii::app()->name).' | Auth';?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
        'items' => array(
            array(
                'label' => Yii::t('AuthModule.main', 'Assignments'),
                'url' => array('/auth/assignment/index'),
                'active' => $this instanceof AssignmentController,
            ),
            array(
                'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_ROLE, true)),
                'url' => array('/auth/role/index'),
                'active' => $this instanceof RoleController,
            ),
            array(
                'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_TASK, true)),
                'url' => array('/auth/task/index'),
                'active' => $this instanceof TaskController,
            ),
            array(
                'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_OPERATION, true)),
                'url' => array('/auth/operation/index'),
                'active' => $this instanceof OperationController,
            ),
        ),
    ));?>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1">
                <?php $this->widget('bootstrap.widgets.TbNav', array(
                    'type'=>'list',
                    'items'=> $this->menu
                )); ?>
            </div>
            <div class="span11 auth-module">
                <?php echo $content; ?>
            </div>
        </div>
    </div>

</body>
</html>