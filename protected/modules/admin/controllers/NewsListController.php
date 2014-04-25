<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 25.12.13
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */

class NewslistController extends AdminController
{
    public function actionCreate()
    {
        $model = new NewsList;
        $model->page_size = 5;
        $success = $model->save();
        if( $success ) {
            $this->redirect(array('/admin/newsList/update', 'id'=>$model->id));
        } else {
            $this->render('create', array('model' => $model));
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('NewsList', $id);
        $newsFinder = new News('search');
        $newsFinder->unsetAttributes();
        if ( isset($_GET['News']) ) {
            $newsFinder->attributes = $_GET['News'];
        }
        $newsFinder->list_id = $model->id;

        if(isset($_POST['NewsList']))
        {
            $model->attributes = $_POST['NewsList'];
            $success = $model->save();
            if( $success ) {
                Yii::app()->user->setFlash('SAVED', 'Настройки сохранены');
            }
        }
        $this->render('update', array(
            'model' => $model,
            'newsFinder' => $newsFinder
        ));
    }
}