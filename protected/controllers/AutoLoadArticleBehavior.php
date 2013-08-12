<?php
/**
 * Вывод на все страницы автоподгружаемой ленты блога
 * Поведение для контроллера
 */
class AutoLoadArticleBehavior extends CBehavior
{
    public $blogPageVar = 'page';
    public $blogPageSize = 5;
    public $blogDataProvider;
    
    protected function processPageRequest($param = 'page')
    {        
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }
    
    public function start()
    {
        if ( $this->owner->layout != '//layouts/column1' ) {
            return;
        }
        
        if ( Yii::app()->request->isAjaxRequest && !isset($_GET['LOAD_ARTICLES']) ) {
            return;
        }
        
        $model = new Article('search');
        if ( isset($_POST['Article']['isSearch']) ) {
            $model->attributes = $_POST['Article'];
        }
        $this->processPageRequest($this->blogPageVar);
        
        //if ( $this->blogDataProvider === null ) {
            $this->blogDataProvider = $model->search(array(
                'pagination'=>array(
                    'pageSize'=>$this->blogPageSize,
                    'pageVar' =>$this->blogPageVar,
                )
            ));
        //}
        if ( Yii::app()->request->isAjaxRequest && isset($_GET['LOAD_ARTICLES']) ) {
            echo $this->owner->renderPartial('application.views.site._loopAjax', array(
                'dataProvider'=>$this->blogDataProvider,
                'itemView'=>'application.views.article._view',
            ));
            Yii::app()->end();
        }
    }
}