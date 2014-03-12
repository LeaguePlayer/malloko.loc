<?php

class PageController extends AdminController
{
    public function actionCreate()
    {
        $model = new Page();

        $node_id = Yii::app()->request->getQuery('node_id');
        if ( $node_id ) {
            $node = Structure::model()->findByPk($node_id);
        }
        if ( $node ) {
            $model->title = $node->name;
        }

        if(isset($_POST['Page']))
        {
            $model->attributes = $_POST['Page'];
            $success = $model->save();
            if( $success ) {

                if ( $node && $node->name !== $model->title ) {
                    $node->name = $model->title;
                    $node->saveNode();
                }

                $message = 'Страница успешно сохранена. Теперь вы можете добавить '.TbHtml::link('галерею', '#');
                Yii::app()->user->setFlash('PAGE_SAVED', $message);
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('Page', $id);
        if(isset($_POST['Page']))
        {
            $model->attributes = $_POST['Page'];
            $success = $model->save();
            if( $success ) {
                $node = $model->node;
                if ( $node && $node->name !== $model->title ) {
                    $node->name = $model->title;
                    $node->saveNode();
                }
                $this->redirect(array('/admin/structure/list'));
            }
        }
//        Yii::import('appext.imagesmultigallery.GalleryManager');
//        GalleryManager::registerScripts();
        $this->render('update', array('model' => $model));
    }
}
