<?php

/**
 * This is the model class for table "gallery".
 *
 * The followings are the available columns in table 'gallery':
 * @property integer $id
 * @property string $versions_data
 * @property integer $name
 * @property integer $description
 *
 * The followings are the available model relations:
 * @property GalleryPhoto[] $galleryPhotos
 *
 * @property array $versions Settings for image auto-generation
 * @example
 *  array(
 *       'small' => array(
 *              'resize' => array(200, null),
 *       ),
 *      'medium' => array(
 *              'resize' => array(800, null),
 *      )
 *  );
 *
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class Gallery extends CActiveRecord
{
	const METHOD_RESIZE = 'resize';
	const METHOD_ADAPTIVERESIZE = 'adaptiveResize';
	const METHOD_CROP = 'crop';
	const METHOD_CENTEREDPREVIEW = 'centeredpreview';


	public static function getMethods()
	{
		return array(
			self::METHOD_RESIZE => 'Масштабирование',
			self::METHOD_ADAPTIVERESIZE => 'Адаптированное масшт.',
			self::METHOD_CROP => 'Отсечение',
			self::METHOD_CENTEREDPREVIEW => 'Масштабирвоание от центра',
		);
	}


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gallery the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        if ($this->dbConnection->tablePrefix !== null)
            return '{{gallery}}';
        else
            return 'gallery';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
			array('gallery_name', 'required'),
			array('gallery_name', 'unique'),
            array('name, description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sizes, name, description', 'safe', 'on' => 'search'),
        );
    }

	public function free()
	{
		$criteria = new CDbCriteria();
		return $this->getDbCriteria()->mergeWith(array(

		));
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'galleryPhotos' => array(self::HAS_MANY, 'GalleryPhoto', 'gallery_id', 'order' => '`rank` asc'),
        	'entities' => array(self::HAS_MANY, 'EntityGallery', 'gallery_id')
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'alias' => 'Алиас',
            'gallery_name' => 'Название галереи',
            'name' => 'Подписи к фотографиям',
            'description' => 'Описание к фотографиям',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name);
		$criteria->compare('description', $this->description);
		$criteria->compare('alias', $this->name);
		$criteria->compare('gallery_name', $this->name);
		$criteria->order = 'gallery_name';

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    private $_versions;

    public function getVersions()
    {
        if (empty($this->_versions)) $this->_versions = unserialize($this->versions_data);
        return $this->_versions;
    }

    public function setVersions($value)
    {
        $this->_versions = $value;
    }

    protected function beforeSave()
    {
        if (!empty($this->_versions))
            $this->versions_data = serialize($this->_versions);
		if ( empty($this->alias) )
			$this->alias = self::translit($this->gallery_name);
        return parent::beforeSave();
    }

    public function delete()
    {
        foreach ($this->galleryPhotos as $photo) {
            $photo->delete();
        }
		foreach ( $this->entities as $entity ) {
			$entity->delete();
		}
        return parent::delete();
    }

	public static function translit($str) {
		$tr = array(
			"А" => "a", "Б" => "b", "В" => "v", "Г" => "g",
			"Д" => "d", "Е" => "e", "Ж" => "j", "З" => "z", "И" => "i",
			"Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
			"О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
			"У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
			"Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
			"Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
			"в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
			"з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
			"м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
			"с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
			"ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
			"ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
			" " => "_", "." => "_", "/" => "-", "(" => "", ")" => "",
		);
		return strtr($str, $tr);
	}
}