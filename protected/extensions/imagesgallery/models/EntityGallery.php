<?php
/**
 * User: megakuzmitch
 * Date: 05.04.14
 * Time: 19:37
 */

class EntityGallery extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gallery the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{entity_gallery}}';
	}
}