<?php
/**
 * @property string $savePath путь к директории, в которой сохраняем файлы
 */
class UploadableImageBehavior extends CActiveRecordBehavior
{
    /**
     * @var string название атрибута, хранящего в себе имя файла и файл
     */
    public $attributeName='image';
	
    /**
     * @var string алиас директории, куда будем сохранять файлы (убедись, что директория существует)
     */
    public $savePath='/media/images/';
	public $thumbsPath='/media/images/thumbs/';
	public $thumbs = array(
		'small' => array(90, 90),
		'medium' => array(300, 200),
		'big' => array(800, 600),
	);
	
    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios = array('insert','update');
	
    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes='jpg, png, jpeg, gif';
 
    /**
     * Шорткат для Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.
     * Возвращает путь к директории, в которой будут сохраняться файлы.
     * @return string путь к директории, в которой сохраняем файлы
     */
    public function getAbsoluteSavePath(){
        return Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->savePath;
    }
	
	public function getAbsoluteThumbsPath(){
        return Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->thumbsPath;
    }
 
    public function attach($owner){
        parent::attach($owner);
        if(in_array($owner->scenario,$this->scenarios)){
            // добавляем валидатор файла
            $fileValidator=CValidator::createValidator('file',$owner,$this->attributeName,
                array('types'=>$this->fileTypes,'allowEmpty'=>true));
            $owner->validatorList->add($fileValidator);
        }
    }
 
    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeSave($event){
        if(in_array($this->owner->scenario,$this->scenarios) &&
            ($file=CUploadedFile::getInstance($this->owner,$this->attributeName))){
            $this->processDelete(); // старые файлы удалим, потому что загружаем новый
			
			$fileName = SiteHelper::genUniqueKey().'.'.$file->extensionName;
            $this->owner->setAttribute($this->attributeName,$fileName);
            $file->saveAs($this->absoluteSavePath.$fileName);
			$this->createThumbs($this->absoluteSavePath, $fileName);
        }
        return true;
    }
 
    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeDelete($event){
		$this->processDelete();
    }
	
	protected function processDelete()
	{
		$this->deleteThumbs();
        $this->deleteFile(); // удалили модель? удаляем и файл, связанный с ней
	}
 
    public function deleteFile(){
        $filePath=$this->absoluteSavePath.$this->owner->getAttribute($this->attributeName);
        if(@is_file($filePath))
            @unlink($filePath);
    }
	
	public function deleteThumbs()
	{
		$thumbsPath = $this->thumbsPath;
		$originalFile = $this->owner->getAttribute($this->attributeName);
		foreach ( $this->thumbs as $prefix => $size ) {
			$thumbFile = $thumbsPath.$prefix.'_'.$originalFile;
			if(@is_file($thumbFile))
				@unlink($thumbFile);
		}
	}
	
	protected function createThumbs($filePath, $fileName)
	{
		$thumbsPath = $this->absoluteThumbsPath;
		$thumb = new EPhpThumb();
		$thumb->init();
		foreach ( $this->thumbs as $prefix => $size ) {
			$thumb->create($filePath.$fileName)->resize($size[0], $size[1])->save($thumbsPath.$prefix.'_'.$fileName);
		}
	}
	
	public function getThumb($prefix)
	{
		return $this->thumbsPath.$prefix.'_'.$this->owner->getAttribute($this->attributeName);
	}
}
