<?php

/**
 * This is the model class for table "{{email_templates}}".
 *
 * The followings are the available columns in table '{{email_templates}}':
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $subject
 * @property string $from
 * @property integer $send_interval
 * @property string $last_send_date
 * @property integer $send_status
 * @property string $content
 * @property integer $create_time
 * @property integer $update_time
 */
class EmailTemplates extends CActiveRecord
{
    const SEND_STATUS_PROCESS = 1;
    const SEND_STATUS_FINISH = 0;

    public function tableName()
    {
        return '{{email_templates}}';
    }


    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
            )
        );
    }


    public function rules()
    {
        return array(
            array('subject, from, content, alias', 'required'),
            array('send_interval, send_status, create_time, update_time', 'numerical', 'integerOnly'=>true),
            array('name, alias, subject, from', 'length', 'max'=>255),
            array('from', 'email'),
            array('alias', 'unique'),
            // The following rule is used by search().
            array('id, name, alias, subject, from, send_interval, last_send_date, send_status, content, create_time, update_time', 'safe', 'on'=>'search'),
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
            'name' => 'Название шаблона',
            'alias' => 'Идентификатор шаблона',
            'subject' => 'Тема письма',
            'from' => 'От кого',
            'send_interval' => 'Периодичность рассылки',
            'last_send_date' => 'Дата последней рассылки',
            'send_status' => 'Статус рассылки',
            'content' => 'Шаблон письма',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('subject',$this->subject,true);
        $criteria->compare('from',$this->from,true);
        $criteria->compare('send_interval',$this->send_interval);
        $criteria->compare('last_send_date',$this->last_send_date,true);
        $criteria->compare('send_status',$this->send_status);
        $criteria->compare('content',$this->content,true);
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


    public function beforeSave()
    {
        if ( empty( $this->send_interval ) )
            $this->send_interval = 1;
        if ( empty( $this->send_status ) )
            $this->send_status = self::SEND_STATUS_FINISH;
        return parent::beforeSave();
    }
}