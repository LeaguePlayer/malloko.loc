<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 30.08.13
 * Time: 14:58
 * To change this template use File | Settings | File Templates.
 */

class SortAction extends AdminAction
{
    public function run()
    {
        if (isset($_POST['items']) && is_array($_POST['items'])) {

            $actualIds = implode(", ",$_POST['items']);
            $actualModels = CActiveRecord::model($this->getModelName())->findAll(array(
                'select'=>"id, sort",
                'condition'=>"id in ({$actualIds})",
                'order'=>"sort ASC" ));

            $aValues = array_values( CHtml::listData($actualModels, 'id', 'sort') );

            $i = 0;
            foreach ($_POST['items'] as $id) {
                CActiveRecord::model($this->getModelName())->updateByPk($id, array('sort'=>$aValues[$i++]));
            }
        }
    }
}