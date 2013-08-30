<?php

class CkeditorWidget extends CInputWidget{

	//rotected $forceCopyAssets = false;

	//protected $assetsUrl;

	public $name;
	public $config = array();
	

	public function run(){
		list($this->name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$this->name=$this->htmlOptions['name'];

		if($this->hasModel())
			echo CHtml::activeTextarea($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textArea($this->name,$this->value,$this->htmlOptions);

		$this->registerClientScripts();
	}

	private function registerClientScripts(){
		$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$assetsPath = Yii::app()->assetManager->publish($path);
		Yii::app()->clientScript->registerScriptFile($assetsPath.DIRECTORY_SEPARATOR.'ckeditor.js');
		
		$fileManagerDir = $assetsPath.'/kcfinder';

		$config = CMap::mergeArray(array(
			'height' => 400,
			'width' => '65.812%',
			'filebrowserBrowseUrl' => $fileManagerDir.'/browse.php?type=files',
			'filebrowserImageBrowseUrl' => $fileManagerDir.'/browse.php?type=images',
			'filebrowserFlashBrowseUrl' => $fileManagerDir.'/browse.php?type=flash',
			'filebrowserUploadUrl' => $fileManagerDir.'/upload.php?type=files',
			'filebrowserImageUploadUrl' => $fileManagerDir.'/upload.php?type=images',
			'filebrowserFlashUploadUrl' => $fileManagerDir.'/upload.php?type=flash',
		), $this->config);	
		
		$configObject = CJSON::encode($config);
		Yii::app()->clientScript->registerScript('#ckeditor'.$this->id, '
			CKEDITOR.replace("'.$this->name.'", '. $configObject .');
		', CClientScript::POS_READY);
	}

	/*public function getAssetsUrl()
    {
        if (!isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name.'.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }
        return $this->assetsUrl;
    }*/
}