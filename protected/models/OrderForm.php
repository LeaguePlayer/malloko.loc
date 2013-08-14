<?php

class OrderForm extends CFormModel
{
	public $name;
    public $phone;
	public $date;

	public function rules()
	{
		return array(
			// username and password are required
			array('name, phone, date', 'required'),
		);
	}
    
	public function attributeLabels()
	{
		return array(
			'name'=>'Ваше имя',
            'phone'=>'Ваш телефон',
			'date'=>'На какое время',
		);
	}
}
