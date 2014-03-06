<?php
/**
 * Миграция m140306_092421_initialize_structure
 *
 * @property string $prefix
 */
 
class m140306_092421_initialize_structure extends CDbMigration
{
 
    public function safeUp()
    {
        $this->insert('{{materials}}', array(
            'class_name' => 'Page',
            'name' => 'Страница'
        ));
        $id = $this->getDbConnection()->getLastInsertID();
        $this->insert('{{structure}}', array(
            'name' => 'Главная страница',
            'material_id' => $id,
            'url' => 'main',
            'level' => 1,
            'lft' => 1,
            'rgt' => 2
        ));
    }
 
    public function safeDown()
    {
        $this->truncateTable('{{materials}}');
        $this->truncateTable('{{structure}}');
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