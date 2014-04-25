<?php

class NewsListController extends FrontController
{
	public function actionView($url = 'news')
	{
		$node = Structure::model()->findByUrl($url);
		if ( !$node )
			throw new CHttpException(404, 'Новостей не найдено');
		$newslist = $node->getComponent();
		$dataProvider = $newslist->newsSearch();

		$this->buildMenu($node);
		$this->breadcrumbs = $node->getBreadcrumbs();

		if ( !empty($node->seo->meta_title) )
			$this->title = $node->seo->meta_title;
		else
			$this->title = $node->name.' | '.Yii::app()->config->get('app.name');
		Yii::app()->clientScript->registerMetaTag($node->seo->meta_desc, 'description', null, array('id'=>'meta_description'), 'meta_description');
		Yii::app()->clientScript->registerMetaTag($node->seo->meta_keys, 'keywords', null, array('id'=>'keywords'), 'meta_keywords');

		$this->render('index', array(
			'dataProvider'=>$dataProvider,
			'node'=>$node,
		));
	}
}