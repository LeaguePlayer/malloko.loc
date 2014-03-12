<?php

/**
* This is the model class for table "{{pages}}".
*
* The followings are the available columns in table '{{pages}}':
    * @property integer $id
    * @property string $title
    * @property string $description
    * @property string $wswg_body
    * @property string $img_preview
    * @property integer $node_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Page extends StructureMaterial
{
    public function tableName()
    {
        return '{{pages}}';
    }


    public function rules()
    {
        return array(
            array('title', 'required'),
            array('node_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('title, img_preview', 'length', 'max'=>255),
            array('description, wswg_body, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, title, description, wswg_body, img_preview, node_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'node' => array(self::BELONGS_TO, 'Structure', 'node_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок страницы',
            'description' => 'Краткое описание',
            'wswg_body' => 'Тело страницы',
            'img_preview' => 'Превью',
            'node_id' => 'Ссылка на раздел',
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
					)
				),
			),
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('wswg_body',$this->wswg_body,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('node_id',$this->node_id);
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


}
