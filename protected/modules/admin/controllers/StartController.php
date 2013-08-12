<?php

class StartController extends AdminController{

	public function actionIndex() {
		
		
		if (isset($_POST['Settings'])) {
			foreach ( $_POST['Settings'] as $option => $value ) {
				Settings::setOption($option, $value);
			}
		}
		$this->render('index', array('settings' => Settings::model()->findAll()));
	}
}