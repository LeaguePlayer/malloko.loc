<?php

/**
* This is the model class for table "{{news}}".
*
* The followings are the available columns in table '{{news}}':
    * @property integer $id
    * @property string $title
    * @property string $img_preview
    * @property string $short_description
    * @property string $body_content
    * @property string $tags
    * @property integer $list_id
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class News extends EActiveRecord
{
    public function tableName()
    {
        return '{{news}}';
    }


    public function rules()
    {
        return array(
            array('title', 'required'),
            array('list_id, seo_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('create_time, update_time, short_description, body_content, tags', 'safe'),
            // The following rule is used by search().
            array('id, title, img_preview, short_description, body_content, tags, list_id, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'list'=>array(self::BELONGS_TO, 'NewsList', 'list_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'img_preview' => 'Превью',
            'short_description' => 'Краткое описание',
            'body_content' => 'Контент',
            'tags' => 'Тэги',
            'list_id' => 'List',
            'seo_id' => 'Seo',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'imgBehaviorPreview' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_preview',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					),
					'big' => array(
						'adaptiveResize' => array(800, 600),
					),
				),
			),
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
			'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('body_content',$this->body_content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			Tag::model()->updateValues($this->tags);
			return true;
		}
		return false;
	}

	private $_tags;
	public function getTagObjects()
	{
		if ( $this->_tags === null ) {
			$tags = explode(',', $this->tags);
		}
		return $this->_tagItems;
	}

	public function getUrl()
	{
		return Yii::app()->createUrl('/news/view', array('id'=>$this->id));
	}
}
