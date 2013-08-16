<?php

class SiteController extends Controller
{
	public $layout = '//layouts/col_2';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/col_1';
		$this->currentPage = 'main';
		$slider = Slider::model()->findByAttributes(array('place_id'=>$this->place['id']));
		if ( $slider !== null and $slider->status == Slider::STATUS_PUBLISH ) {
			$this->sliderManager = $slider->galleryManager->getGallery();
		}
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/simple';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionAbout()
	{
		$this->layout = '//layouts/col_2';
		$this->render('about');
	}
    
    public function actionOrder()
    {
        $model = new OrderForm;
		$model->date = date("d-m-Y H:i", time() + 60*60);
		
		if ( isset($_POST['OrderForm']) ) {
			$model->attributes = $_POST['OrderForm'];
			if ( $model->validate() ) {
				$subject = "Заявка с сайта http://cherepaha-rest.ru/";
				$date = SiteHelper::russianDate($model->date)." ".date('H:i', strtotime($model->date));
				$message = "С сайта http://cherepaha-rest.ru/ поступила заявка на бронирование столика.<br>".
						"<strong>Имя</strong>: {$model->name}<br>".
						"<strong>Телефон</strong>: {$model->phone}<br>".
						"<strong>Дата</strong>: {$date}<br>";
						
				SiteHelper::sendMail($subject, $message, Settings::getOption('admin_email'), 'no-repeat@cherepaha-rest.ru');
				Yii::app()->user->setFlash('SUCCESS_ORDER', 'Ваша заявка принята!');
			}
		}
		
		if ( Yii::app()->request->isAjaxRequest ) {
			$this->renderPartial('order', array('model'=>$model));
			Yii::app()->end();
		}
        $this->render('order', array('model'=>$model));
    }
}