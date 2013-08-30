<?php

class Debug extends CWidget {

	public function run() {
		if (Yii::app()->user->hasFlash('email')) {
			// register js files
			$url = CHtml::asset(Yii::getPathOfAlias('email.components.views.debug') . '.js');
			Yii::app()->getClientScript()->registerCoreScript('jquery');
			Yii::app()->getClientScript()->registerScriptFile($url);

			// register css file
			$url = CHtml::asset(Yii::getPathOfAlias('email.components.views.debug') . '.css');
			Yii::app()->getClientScript()->registerCssFile($url);

			// dump debug info
			$emails = Yii::app()->user->getFlash('email');
			$this->render('debug', compact('emails'));
		}
	}

}