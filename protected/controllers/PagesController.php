<?php

class PagesController extends Controller
{
	public $layout='//layouts/col_2';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($alias = null)
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('status=:status');
		$criteria->params[':status'] = Pages::STATUS_PUBLISH;
		
		if ( $alias === null ) {
			$id = Yii::app()->request->getParam('id');
			$model = $this->loadModel('Pages', $id, $criteria);
		} else {
			$model = Pages::model()->findByAttributes(array('alias'=>$alias), $criteria);
			if ( $model === null ) {
				throw new CHttpException(404, 'Указанная страница ненайдена');
			}
		}
		$this->title = $model->title;
		if ( $alias === 'contacti' ) {
			$this->renderYandexMap = true;
		}
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
}
