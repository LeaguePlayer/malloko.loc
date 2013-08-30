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
        $model = new EmailTemplates('insert');
        if( isset($_POST['EmailTemplates']) )
        {
            $model->attributes = $_POST['EmailTemplates'];
            if( $model->save() ) {
                $this->redirect('list');
            }
        }
        $this->render('form', array('model'=>$model));
    }



    public function actionUpdate($id)
    {
        $model = EmailTemplates::model()->with_all_vars()->findByPk($id); //$this->loadModel('EmailTemplates', $id);

        print_r(count($model->vars));
        if( isset($_POST['EmailTemplates']) )
        {
            $model->attributes = $_POST['EmailTemplates'];
            if( $model->save() ) {
                $this->redirect('list');
            }
        }
        $this->render('form', array('model'=>$model));
    }



    public function actionList()
    {
        $model = new EmailTemplates('search');
        if(isset($_GET['EmailTemplates']))
            $model->attributes = $_GET['EmailTemplates'];

        $this->render('list', array('model'=>$model));
    }
}