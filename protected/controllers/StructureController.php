<?php

class StructureController extends FrontController
{
    public function actionShow($url)
    {
        $node = Structure::model()->findByUrl($url);
        if ( !$node )
            throw new CHttpException(404, 'Раздел не найден');
    }
}