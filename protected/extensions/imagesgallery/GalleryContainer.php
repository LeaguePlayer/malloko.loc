<?php
/**
 * User: megakuzmitch
 * Date: 05.04.14
 * Time: 21:07
 */

class GalleryContainer extends CWidget
{
	public $model;
	public $htmlOptions = array();

	/** @var string Route to gallery controller */
	public $controllerRoute = '/admin/gallery';

	public function init()
	{
		parent::init();
	}

	public static function registerScripts()
	{
		/** @var $cs CClientScript */
		$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets', false, -1, true);

		$cs = Yii::app()->clientScript;
		$cs->registerCssFile($assets . '/galleryContainer.css');
		$cs->registerCssFile($assets . '/galleryManager.css');

		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');

		$cs->registerScriptFile($assets . '/jquery.iframe-transport.js', CClientScript::POS_END);
		$cs->registerScriptFile($assets . '/jquery.galleryManager.js', CClientScript::POS_END);
		$cs->registerScriptFile($assets . '/jquery.galleryContainer.js', CClientScript::POS_END);

		// if (YII_DEBUG) {
		//     $cs->registerScriptFile($this->assets . '/jquery.iframe-transport.js');
		//     $cs->registerScriptFile($this->assets . '/jquery.galleryManager.js');
		// } else {
		//     $cs->registerScriptFile($this->assets . '/jquery.iframe-transport.min.js');
		//     $cs->registerScriptFile($this->assets . '/jquery.galleryManager.min.js');
		// }
	}


	/** Render widget */
	public function run()
	{
		if ($this->model === null)
			throw new CException('$model must be set.', 500);

		if ($this->controllerRoute === null)
			throw new CException('$controllerRoute must be set.', 500);

		self::registerScripts();

		if (Yii::app()->request->enableCsrfValidation) {
			$opts['csrfTokenName'] = Yii::app()->request->csrfTokenName;
			$opts['csrfToken'] = Yii::app()->request->csrfToken;
		}

		$this->htmlOptions['id'] = $this->id;
		if ( !isset( $this->htmlOptions['class'] ) )
			$this->htmlOptions['class'] = 'GalleriesContainer';
		else
			$this->htmlOptions['class'] .= ' GalleriesContainer';

		$opts = array(
			'addGalleryUrl' => Yii::app()->createUrl($this->controllerRoute . '/addGallery'),
			'selectGalleryUrl' => Yii::app()->createUrl($this->controllerRoute . '/selectGallery'),
			'unlinkGalleryUrl' => Yii::app()->createUrl($this->controllerRoute . '/unlinkGallery'),
			'deleteGalleryUrl' => Yii::app()->createUrl($this->controllerRoute . '/deleteGallery'),
			'entity_type' => get_class($this->model),
			'entity_id' => $this->model->id,
		);
		if (Yii::app()->request->enableCsrfValidation) {
			$opts['csrfTokenName'] = Yii::app()->request->csrfTokenName;
			$opts['csrfToken'] = Yii::app()->request->csrfToken;
		}

		$opts = CJavaScript::encode($opts);
		Yii::app()->clientScript->registerScript('galleryContainer#' . $this->id, "$('#{$this->id}').galleryContainer({$opts});", CClientScript::POS_END);

		$existGalleries = CHtml::listData($this->model->getGalleries(), 'id', 'id');
		$criteria = new CDbCriteria();
		$criteria->addNotInCondition('id', $existGalleries);
		$otherGalleries = Gallery::model()->findAll($criteria);
		$this->render('galleriesContainer', array(
			'newGallery' => new Gallery(),
			'otherGalleries'=>$otherGalleries
		));
	}
}