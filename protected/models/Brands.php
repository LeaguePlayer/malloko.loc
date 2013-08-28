<?php

/**
 * This is the model class for table "{{brands}}".
 *
 * The followings are the available columns in table '{{brands}}':
 * @property integer $id
 * @property string $img_1
 * @property string $img_2
 * @property integer $gllr_slides
 * @property integer $gllr_thumbs
 * @property string $dttm_datetime
 * @property string $dt_date
 * @property string $tm_time
 * @property string $dttm_datetime2
 * @property string $wswg_content
 * @property string $wswg_description
 * @property string $msk_field
 * @property string $msk_field2
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Brands extends EActiveRecord
{
	public function tableName()
	{
		return '{{brands}}';
	}

	
	public function rules()
	{
		return array(
			array('gllr_slides, gllr_thumbs, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('img_1, img_2, msk_field, msk_field2', 'length', 'max'=>255),
			array('dttm_datetime, dt_date, tm_time, dttm_datetime2, wswg_content, wswg_description', 'safe'),
			// The following rule is used by search().
			array('id, img_1, img_2, gllr_slides, gllr_thumbs, dttm_datetime, dt_date, tm_time, dttm_datetime2, wswg_content, wswg_description, msk_field, msk_field2, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'img_1' => 'Картинка 1',
			'img_2' => 'Картинка 2',
			'gllr_slides' => 'Галерея 1',
			'gllr_thumbs' => 'Галерея 2',
			'dttm_datetime' => 'Date 1',
			'dt_date' => 'Date 2',
			'tm_time' => 'Date 3',
			'dttm_datetime2' => 'Date 4',
			'wswg_content' => 'Текст',
			'wswg_description' => 'Текст',
			'msk_field' => 'Текст по маске',
			'msk_field2' => 'Текст по маске 2',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'imgBehavior1' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_1',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
			'imgBehavior2' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_2',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
			'galleryBehaviorSlides' => array(
				'class' => 'admin.extensions.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_slides',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(600, 500),
					)
				),
				'name' => true,
				'description' => true,
			),
			'galleryBehaviorThumbs' => array(
				'class' => 'admin.extensions.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_thumbs',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(600, 500),
					)
				),
				'name' => true,
				'description' => true,
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('img_1',$this->img_1,true);
		$criteria->compare('img_2',$this->img_2,true);
		$criteria->compare('gllr_slides',$this->gllr_slides);
		$criteria->compare('gllr_thumbs',$this->gllr_thumbs);
		$criteria->compare('dttm_datetime',$this->dttm_datetime,true);
		$criteria->compare('dt_date',$this->dt_date,true);
		$criteria->compare('tm_time',$this->tm_time,true);
		$criteria->compare('dttm_datetime2',$this->dttm_datetime2,true);
		$criteria->compare('wswg_content',$this->wswg_content,true);
		$criteria->compare('wswg_description',$this->wswg_description,true);
		$criteria->compare('msk_field',$this->msk_field,true);
		$criteria->compare('msk_field2',$this->msk_field2,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

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
		return 'Новости ресторана';
	}

	public function beforeSave()
	{
		if (!empty($this->dttm_datetime))
			$this->dttm_datetime = Yii::app()->date->toMysql($this->dttm_datetime);
		if (!empty($this->dt_date))
			$this->dt_date = Yii::app()->date->toMysql($this->dt_date);
		if (!empty($this->tm_time))
			$this->tm_time = Yii::app()->date->toMysql($this->tm_time);
		if (!empty($this->dttm_datetime2))
			$this->dttm_datetime2 = Yii::app()->date->toMysql($this->dttm_datetime2);
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dttm_datetime = ($this->dttm_datetime !== '0000-00-00 00:00:00' ) ? date('d-m-Y H:i', strtotime($this->dttm_datetime)) : '';
			$this->dt_date = ($this->dt_date !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_date)) : '';
			$this->tm_time = ($this->tm_time !== '00:00:00' ) ? date('H:i', strtotime($this->tm_time)) : '';
			$this->dttm_datetime2 = ($this->dttm_datetime2 !== '0000-00-00 00:00:00' ) ? date('d-m-Y H:i', strtotime($this->dttm_datetime2)) : '';
		}
	}
}
