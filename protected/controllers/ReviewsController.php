<?php

class ReviewsController extends Controller
{
	public $layout='//layouts/col_2';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'ajaxOnly + loadMore',
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('loadMore', 'add'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionLoadMore()
	{
		if (isset($_POST['page']))
            $_GET[$param] = Yii::app()->request->getPost('page');
		
		$criteria = new CDbCriteria;
		$criteria->addCondition('status=:status');
		$criteria->params[':status'] = Reviews::STATUS_PUBLISH;
		$criteria->order = 'create_time DESC';
		$dataProvider = new CActiveDataProvider('Reviews', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 3,
				'pageVar' => 'page',
			),
		));
		echo $this->renderPartial('application.extensions.reviews.views.ajax_reviews', array(
			'dataProvider'=>$dataProvider,
		), true);
	}
	
	public function actionAdd()
	{
		$model = new Reviews;
		
		if ( isset($_POST['Reviews']) ) {
			$model->attributes = $_POST['Reviews'];
			$model->status = Reviews::STATUS_CLOSED;
			if ( $model->save() ) {
				Yii::app()->user->setFlash('SUCCESS_REVIEW', 'Спасибо за отзыв! Нам не безразлично Ваше мнение.');
			}
		}
		
		if ( Yii::app()->request->isAjaxRequest ) {
			$this->renderPartial('_form', array('model'=>$model));
			Yii::app()->end();
		}
		
		$this->render('_form', array('model'=>$model));
	}
}
