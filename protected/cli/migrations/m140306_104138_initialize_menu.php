<?php
/**
 * Миграция m140306_104138_initialize_menu
 *
 * @property string $prefix
 */
 
class m140306_104138_initialize_menu extends CDbMigration
{
 
    public function safeUp()
    {
        $this->insert('{{menu}}', array(
            'name' => 'Главное меню',
            'item_class' => 'home',
            'level' => 1,
            'lft' => 1,
            'rgt' => 2
        ));
    }
 
    public function safeDown()
    {
        $this->truncateTable('{{menu}}');
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}