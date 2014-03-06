<?php

class MenuController extends AdminController
{
    public $layout = '/layouts/structure';

    public function filters()
    {
        return CMap::mergeArray(
            parent::filters(),
            array(
                'postOnly + moveUp, moveDown',
                'ajaxOnly + moveUp, moveDown',
            )
        );
    }

    public function actionCreate($parent_id = 0)
    {
        $model = new Menu();
        $model->parent_id = $parent_id;

        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, level, lft, rgt';
        $criteria->order = 'lft';
        $menuItems = Menu::model()->findAll($criteria);
        $menuList = array();
        foreach ( $menuItems as $item ) {
            $menuList[$item->id] = str_repeat('––', $item->level - 1)." ".$item->name;
        }

        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, level, lft, rgt';
        $criteria->order = 'lft';
        $structureItems = Structure::model()->findAll($criteria);
        $structureList = array();
        foreach ( $structureItems as $item ) {
            $structureList[$item->id] = str_repeat('––', $item->level - 1)." ".$item->name;
        }

        if(isset($_POST['Menu']))
        {
            $model->attributes = $_POST['Menu'];
            foreach ( $menuItems as $item ) {
                if ( $model->parent_id == $item->id ) {
                    $model->appendTo($item);
                    $this->redirect(array('/admin/menu/list'));
                    break;
                }
            }
        }

        $this->layout = '/layouts/admin_columns';
        $this->render('create', array(
            'model' => $model,
            'menuList' => $menuList,
            'structureList' => $structureList,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('Menu', $id);

        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, level, lft, rgt';
        $criteria->addCondition('id<>'.$model->id);
        $criteria->order = 'lft';
        $menuItems = Menu::model()->findAll($criteria);
        $menuList = array();
        foreach ( $menuItems as $item ) {
            $menuList[$item->id] = str_repeat('––', $item->level - 1)." ".$item->name;
        }

        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, level, lft, rgt';
        $criteria->order = 'lft';
        $structureItems = Structure::model()->findAll($criteria);
        $structureList = array();
        foreach ( $structureItems as $item ) {
            $structureList[$item->id] = str_repeat('––', $item->level - 1)." ".$item->name;
        }

        if(isset($_POST['Menu']))
        {
            $model->attributes = $_POST['Menu'];
            if ( $model->saveNode() ) {
                $this->redirect(array('/admin/menu/list'));
            }
        }

        $this->layout = '/layouts/admin_columns';
        $this->render('create', array(
            'model' => $model,
            'menuList' => $menuList,
            'structureList' => $structureList,
        ));
    }

    public function actionDelete($id)
    {
        $model = Menu::model()->findByPk($id);
        if ( $model )
            $model->deleteNode();
        $this->redirect(array('list'));
    }

    public function actionMoveDown()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Menu', $id);
        $nextNode = $node->next()->find();
        if ( !$nextNode ) {
            $success = false;
        } else if ( $node->moveAfter($nextNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'down'));
    }

    public function actionMoveUp()
    {
        $id = $_POST['id'];
        $node = $this->loadModel('Menu', $id);
        $prevNode = $node->prev()->find();
        if ( !$prevNode ) {
            $success = false;
        } else if ( $node->moveBefore($prevNode) ) {
            $success = true;
        } else {
            $success = false;
        }
        echo CJSON::encode(array('success'=>$success, 'action'=>'up'));
    }
}
