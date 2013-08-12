<?php

class MenuController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionView($id)
	{
		$this->layout = '//layouts/col_2';
		
		$criteria = new CDbCriteria;
		$criteria->addCondition('place_id=:place_id AND status=:status');
		$criteria->params[':place_id'] = $this->place['id'];
		$criteria->params[':status'] = Menu::STATUS_PUBLISH;
		$model = $this->loadModel('Menu', $id, $criteria);
		
		$criteria->order = 'create_time';
		$criteria->addCondition('id<>:id');
		$criteria->params[':id'] = $id;
		$criteria->limit = 10;
		$othersMenu = new CActiveDataProvider('Menu', array(
			'criteria' => $criteria,
			'pagination' => false
		));
		
		$this->render('view',array(
			'model' => $model,
			'othersMenu' => $othersMenu,
		));
	}

	
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'create_time';
		$criteria->addCondition('status=:status AND place_id=:place_id');
		$criteria->params[':status'] = Menu::STATUS_PUBLISH;
		$criteria->params[':place_id'] = $this->place['id'];
		$dataProvider=new CActiveDataProvider('Menu', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 10
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
