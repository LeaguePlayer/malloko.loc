<?php

class NewsController extends AdminController
{
	public function actionCreate($list_id)
    {
        $model = new News();
        $model->list_id = $list_id;

        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            $success = $model->save();
            if( $success ) {
                $this->redirect(array('/admin/newsList/update', 'id'=>$model->list_id));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('News', $id);
        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            $success = $model->save();
            if( $success ) {
                $this->redirect(array('/admin/newsList/update', 'id'=>$model->list_id));
            }
        }
        $this->render('update', array('model' => $model));
    }
}
