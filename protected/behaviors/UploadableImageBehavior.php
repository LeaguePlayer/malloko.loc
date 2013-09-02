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
    public $saveUrl='media/images';
    protected $thumbsUrl;
    public $versions = array();

    protected $absoluteSavePath;
    protected $absoluteThumbsPath;

    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios = array('insert','update');

    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes='jpg, png, jpeg, gif';

    public function events(){
        return array(
            'onBeforeSave' => 'beforeSave',
            'onBeforeDelete' => 'beforeDelete',
        );
    }


    /**
     * Шорткат для Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.
     * Возвращает путь к директории, в которой будут сохраняться файлы.
     * @return string путь к директории, в которой сохраняем файлы
     */
    public function getAbsoluteSavePath() {
        if ( $this->absoluteSavePath === null ) {
            $directories = explode('/', $this->saveUrl);
            $path = Yii::getPathOfAlias('webroot');
            foreach ($directories as $subdirectory) {
                if ( empty($subdirectory) ) continue;
                $path .= DIRECTORY_SEPARATOR.$subdirectory;
            }
            $path .= DIRECTORY_SEPARATOR.strtolower(get_class($this->owner));
            if ( !@is_dir($path) ) {
                mkdir($path, 0777, true);
            }
            $this->absoluteSavePath = $path;
        }
        return $this->absoluteSavePath;
    }


    public function getAbsoluteThumbsPath(){
        if ( $this->absoluteThumbsPath === null ) {
            $path = $this->getAbsoluteSavePath();
            $path .= DIRECTORY_SEPARATOR.'thumbs';
            if ( !@is_dir($path) ) {
                mkdir($path, 0777, true);
            }
            $this->absoluteThumbsPath = $path;
        }
        return $this->absoluteThumbsPath;
    }

    public function getThumbsUrl()
    {
        if ( $this->thumbsUrl === null ) {
            $this->thumbsUrl = $this->saveUrl.'/'.strtolower(get_class($this->owner)).'/thumbs';
        }
        return $this->thumbsUrl;
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
            $file->saveAs($this->getAbsoluteSavePath().DIRECTORY_SEPARATOR.$fileName);
            $this->createThumbs($this->getAbsoluteSavePath(), $fileName);
        }
        return true;
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeDelete($event){
        $this->processDelete();
        return true;
    }

    protected function processDelete()
    {
        $this->deleteThumbs();
        $this->deleteFile(); // удалили модель? удаляем и файл, связанный с ней
    }

    public function deleteFile() {
        $filePath=$this->getAbsoluteSavePath().DIRECTORY_SEPARATOR.$this->owner->getAttribute($this->attributeName);
        if(@is_file($filePath))
            @unlink($filePath);
    }

    public function deleteThumbs()
    {
        $thumbsPath = $this->getAbsoluteThumbsPath();
        $fileName = $this->owner->getAttribute($this->attributeName);
        foreach ($this->versions as $version => $actions) {
            $thumbFile = $thumbsPath.DIRECTORY_SEPARATOR.$version.'_'.$fileName;
            if(@is_file($thumbFile))
                @unlink($thumbFile);
        }
    }

    public function deletePhoto()
    {
        $this->processDelete();
        $this->owner->{$this->attributeName} = '';
        $this->owner->save(false);
    }

    protected function createThumbs($filePath, $fileName)
    {
        $thumbsPath = $this->getAbsoluteThumbsPath();
        $thumb = new EPhpThumb();
        $thumb->init();

        foreach ($this->versions as $version => $actions) {
            $image = $thumb->create($filePath.DIRECTORY_SEPARATOR.$fileName);
            foreach ($actions as $method => $args) {
                call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
            }
            $image->save($thumbsPath.DIRECTORY_SEPARATOR.$version.'_'.$fileName);
        }
    }

    public function getImage($version = false, $alt = '', $htmlOptions = array())
    {
        $src = $this->getImageUrl($version);
        if ( class_exists('TbHtml') ) {
            return TbHtml::image($src, $alt, $htmlOptions);
        } else {
            return CHtml::image($src, $alt, $htmlOptions);
        }
    }

    public function getImageUrl($version = false)
    {
        if ($version) {
            return '/'.$this->getThumbsUrl().'/'.$version.'_'.$this->owner->getAttribute($this->attributeName);
        } else {
            return '/'.$this->saveUrl.'/'.$this->owner->getAttribute($this->attributeName);
        }
    }
}
