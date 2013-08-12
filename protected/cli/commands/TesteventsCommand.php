<?php
Yii::import('application.components.EActiveRecord');
Yii::import('application.models.Events');

/*
 * Сравнение даты проведения события с текущим днем.
 * Если событие прошло, то его тип меняется на хронику.
 */
class TesteventsCommand extends CConsoleCommand {
    public function run($args) {
        //$newEvents = Events::model()->findAll(array('type' => Events::TYPE_NEWS));
		$newEvents = Yii::app()->db->createCommand()
			->select('id, type, public_date')
			->from('{{events}}')
			->where('type=:type', array(':type'=>Events::TYPE_NEWS))
			->queryAll();
		
		$today = time();
		$counter = 0;
		foreach ( $newEvents as $item ) {
			if ( $today < strtotime($item['public_date']) )
				continue;
			
			Yii::app()->db->createCommand()->update('{{events}}', array(
				'type'=>Events::TYPE_CHRONICLE,
			), 'id=:id', array(':id'=>$item['id']));
			$counter++;
		}
		echo ("Обновлено ".$counter." записей.\n");
    }
}
?>
