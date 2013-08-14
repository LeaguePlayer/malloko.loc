<?php

/**
 * This is the model class for table "{{places}}".
 *
 * The followings are the available columns in table '{{places}}':
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property string $html_description
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Places extends EActiveRecord
{
	public function tableName()
	{
		return '{{places}}';
	}

	
	public function rules()
	{
		return array(
			array('title', 'required'),
			array('status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>256),
			array('html_description', 'safe'),
			// The following rule is used by search().
			array('id, image, title, html_description, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Логотип',
			'title' => 'Название места',
			'html_description' => 'Описание',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'UploadableImageBehavior' => array(
				'class' => 'UploadableImageBehavior',
				'versions' => array(
					'small' => array(
						'resize' => array(90, 0),
					),
					'medium' => array(
						'resize' => array(178, 0),
					),
				)
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('html_description',$this->html_description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->order = 'status, create_time DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function translition()
	{
		return 'Рестораны';
	}
}
