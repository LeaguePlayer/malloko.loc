<?php

class Config extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{config}}';
    }

    public function rules()
    {
        return array(
            array('value', 'safe'),
            array('id, param, value, label, type, default', 'safe', 'on'=>'search'),
        );
    }

    public function getVariants()
    {
        $parts = explode('|', $this->variants);
        $out = array();
        foreach ( $parts as $part ) {
            $pair = explode(':', $part);
            if ( !empty($pair) ) {
                $key = trim($pair[0]);
                $out[$key] = trim($pair[1]);
            }
        }
        return $out;
    }
}