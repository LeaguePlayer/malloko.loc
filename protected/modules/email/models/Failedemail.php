<?php

class FailedEmail extends ActiveRecord {
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function behaviors() {
		return array(
			'AutoTimestampBehavior' => array(
				'class'    => 'AutoTimestampBehavior',
				'created'  => 'sent',
				'modified' => false,
			),
		);
	}
}