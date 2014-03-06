<?php

Yii::import('admin.actions.*');

class AdminController extends Controller
{
    public $layout = '/layouts/admin_columns';
	public $defaultAction = 'list';

    public function filters()
    {
        return array(
            array('auth.filters.AuthFilter'),
        );
    }
	
	public function actions()
    {
        return array(
            'list' => 'ListAction',
			'create' => 'CreateAction',
            'update' => 'UpdateAction',
            'delete' => 'DeleteAction',
            'restore' => 'RestoreAction',
            'view' => 'ViewAction',
            'sort' => 'SortAction',
        );
    }

    /**
     * Render SEO form for @param $model
     * @return mixed|string
     */
    public function getSeoForm($model) {
        $out = '';
        if($model->metaData->hasRelation('seo')) {
            if(isset($model->seo_id)){
                $seo = Seo::model()->findByPk($model->seo_id);
            }
            if ( $seo === null ) {
                $seo = new Seo;
            }

            $out = $this->renderPartial('/seo/_form', array(
                'model' => $seo,
                'title' => $model->getAttributeLabel('seo_id'
            )), true);
        }
        return $out;
    }
}