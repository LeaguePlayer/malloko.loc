<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 30.08.13
 * Time: 14:30
 * To change this template use File | Settings | File Templates.
 */

class SortControllerBehavior extends CBehavior
{
    public $modelClass;
    public $sortAttribute = 'sort';
    public $postName = 'items';

    public function actionSort()
    {
        if (isset($_POST['items']) && is_array($_POST['items'])) {

            $actualIds = implode(", ",$_POST['items']);
            $actualModels = CActiveRecord::model($this->modelClass)->findAll(array(
                'select'=>"id, {$this->sortAttribute}",
                'condition'=>"id in ({$actualIds})",
                'order'=>"{$this->sortAttribute} ASC" ));
            $a = CHtml::listData($actualModels, 'id', 'sort');
            $a = array_values($a);


            $i = 0;
            foreach ($_POST[$this->postName] as $id) {
                CActiveRecord::model($this->modelClass)->updateByPk($id, array('sort'=>$a[$i]));
                $i++;
            }
        }
    }
}