<?php

/**
* This is the model class for table "{{settings_types}}".
*
* The followings are the available columns in table '{{settings_types}}':
    * @property integer $id
    * @property string $name
    * @property string $type
*/
class SettingsTypes extends EActiveRecord
{
    public function tableName()
    {
        return '{{settings_types}}';
    }


    public function rules()
    {
        return array(
            array('name, type', 'required'),
            array('name, type', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, type', 'safe', 'on'=>'search'),
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
            'name' => 'Название',
            'type' => 'Тип',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
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
        return 'Типы полей настроек';
    }

    public static function getTypes(){
        return self::model()->findAll();
    }
}
