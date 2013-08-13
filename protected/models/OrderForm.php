<?php

class OrderForm extends CFormModel
{
	public $name;
    public $phone;

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
		);
	}
}
