<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 29.08.13
 * Time: 13:33
 * To change this template use File | Settings | File Templates.
 */

class EWebModule extends CWebModule
{
    protected $forceCopyAssets = true;
    protected $assetsUrl;


    public function getAssetsUrl()
    {
        if ( !isset($this->assetsUrl) )
        {
            $assetsPath = Yii::getPathOfAlias($this->getName().'.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }
        return $this->assetsUrl;
    }


    public function preinit()
    {
        // Reset the front-end's client script because we don't want
        // both front-end styles being applied in this module.
        Yii::app()->clientScript->reset();
    }


    public function init()
    {
        $this->registerCoreScripts();
    }

    protected function registerBootstrap()
    {
        $this->setAliases(array(
            'bootstrap'=>'appext.yiistrap',
            'yiiwheels'=>'appext.yiiwheels',
        ));
        Yii::app()->setImport(array(
            'bootstrap.helpers.*'
        ));
        Yii::app()->getComponent('bootstrap')->register();
    }

    protected function registerCoreScripts()
    {
    }
}