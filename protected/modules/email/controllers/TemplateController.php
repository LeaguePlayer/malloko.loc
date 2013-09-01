<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 29.08.13
 * Time: 13:14
 * To change this template use File | Settings | File Templates.
 */

class TemplateController extends Controller {
    public $layout = '/layouts/main';
    public $defaultAction = 'list';



    public function actionCreate()
    {
        $model = new EmailTemplates;
        if( isset($_POST['EmailTemplates']) )
        {
            $model->attributes = $_POST['EmailTemplates'];
            if( $model->save() ) {
                $this->redirect('list');
            }
        }
        $this->render('form', array(
            'model'=>$model,
            'variables'=>EmailVars::model()->findAll(),
        ));
    }



    public function actionUpdate($id)
    {
        $model = $this->loadModel('EmailTemplates', $id);
        if( isset($_POST['EmailTemplates']) )
        {
            $model->attributes = $_POST['EmailTemplates'];
            if( $model->save() ) {
                $this->redirect('/email/template/list');
            }
        }
        $this->render('form', array(
            'model'=>$model,
            'variables'=>EmailVars::model()->findAll(),
        ));
    }


    public function actionDelete($id)
    {
        $this->loadModel('EmailTemplates', $id)->delete();
        $this->redirect('/email/template/list');
    }


    public function actionList()
    {
        $model = new EmailTemplates('search');
        if(isset($_GET['EmailTemplates']))
            $model->attributes = $_GET['EmailTemplates'];

        $this->render('list', array('model'=>$model));
    }
}