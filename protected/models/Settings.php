<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property string $option
 * @property string $value
 */
class Settings extends CActiveRecord
{
	public function tableName()
	{
		return '{{settings}}';
	}

	
	public function rules()
	{
		return array(
			array('option', 'required'),
			array('option', 'match', 'pattern'=>'/^[\w]+$/', 'message'=>'Идентификатор параметра не должен содержать русских символов, спецсимволов и пробелов'),
			array('option', 'length', 'max'=>255),
			array('value', 'length', 'max'=>256),
			array('ranges', 'safe'),
			// The following rule is used by search().
			array('option, value', 'safe', 'on'=>'search'),
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
			'option' => 'Параметр',
			'value' => 'Значение',
			'label' => 'Название',
			'ranges' => 'Возможные значения',
		);
	}
	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('option',$this->option,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getOptions()
	{
		return CHtml::listData(self::model()->findAll(), 'option', 'value');
	}
	
	public static function getOption($name)
	{
		$model = self::model()->findByPk($name);
		
		if ( $model === null ) {
			return null;
		} else {
			return $model->value;
		}
	}
	
	public static function setOption($name, $value = null)
	{
		$model = self::model()->findByPk($name);
		if ( $model === null ) {
			$model = new Settings;
			$model->name = $name;
		}
		$model->value = $value;
		$success = $model->save();
		return $success ? $model->value : false;
	}
	
	public static function updateOptionRanges($name, $ranges)
	{
		$model = self::model()->findByPk($name);
		if ( $model === null ) {
			return false;
		}
		$model->ranges = serialize($ranges);
		$success = $model->save();
		return $success ? $model->value : false;
	}
	
	public function beforeSave()
	{
		if ( empty($this->label) ) {
			$this->label = SiteHelper::translit($this->option);
		}
		return parent::beforeSave();
	}
}
