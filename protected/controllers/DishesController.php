<?php

class DishesController extends Controller
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
		$criteria = new CDbCriteria;
		$criteria->addCondition('place_id=:place_id AND status=:status');
		$criteria->params[':place_id'] = $this->place['id'];
		$criteria->params[':status'] = Events::STATUS_PUBLISH;
		$model = $this->loadModel('Dishes', $id, $criteria);
		
		$criteria->order = 'rand()';
		$criteria->addCondition('id<>:id');
		$criteria->params[':id'] = $id;
		$criteria->limit = 2;
		$othersDishes = new CActiveDataProvider('Dishes', array(
			'criteria' => $criteria,
			'pagination' => false
		));
		
		$this->render('view',array(
			'model' => $model,
			'othersDishes' => $othersDishes,
		));
	}

	
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'create_time';
		$criteria->addCondition('status=:status');
		$criteria->params[':status'] = Dishes::STATUS_PUBLISH;
		$dataProvider=new CActiveDataProvider('Dishes', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 12
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
