<?php

Yii::import('admin.extensions.bootstrap.components.Bootstrap');

class AdminBootstrap extends Bootstrap
{

    public $forceCopyAssets = false;

    public function getAssetsUrl()
    {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('application.modules.admin.extensions.bootstrap.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
            return $this->_assetsUrl = $assetsUrl;
        }
    }

}
?>
