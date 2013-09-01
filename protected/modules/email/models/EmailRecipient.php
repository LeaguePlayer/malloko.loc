<?php

/**
 * This is the model class for table "{{email_recipients}}".
 *
 * The followings are the available columns in table '{{email_recipients}}':
 * @property integer $id
 * @property string $email
 * @property integer $template_id
 */
class EmailRecipient extends CActiveRecord
{
    public function tableName()
    {
        return '{{email_recipients}}';
    }


    public function rules()
    {
        return array(
            array('email', 'required'),
            array('template_id', 'numerical', 'integerOnly'=>true),
            array('email', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, email, template_id', 'safe', 'on'=>'search'),
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
            'email' => 'Имя переменной',
            'template_id' => 'Ссылка на шаблон',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('template_id',$this->template_id);
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