<?php

/**
* This is the model class for table "{{settings_string}}".
*
* The followings are the available columns in table '{{settings_string}}':
    * @property integer $id
    * @property string $value
*/
class SettingsString extends EActiveRecord
{
    public function tableName()
    {
        return '{{settings_string}}';
    }


    public function rules()
    {
        return array(
            array('value', 'required'),
            array('value', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, value', 'safe', 'on'=>'search'),
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
            'value' => 'Значение',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('value',$this->value,true);
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
        return 'Настройки';
    }


}
