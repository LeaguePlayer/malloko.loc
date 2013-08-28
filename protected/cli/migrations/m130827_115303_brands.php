<?php
/**
 * Миграция m130827_115303_brands
 *
 * @property string $prefix
 */
 
class m130827_115303_brands extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{brands}}');
 
    public function __construct()
    {
        $this->execute('SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;');
        $this->execute('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;');
        $this->execute('SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE="NO_AUTO_VALUE_ON_ZERO";');
    }
 
    public function __destruct()
    {
        $this->execute('SET SQL_MODE=@OLD_SQL_MODE;');
        $this->execute('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;');
        $this->execute('SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;');
    }
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{brands}}', array(
            'id' => 'pk', // auto increment
			'img_1' => "string COMMENT 'Картинка 1'",
            'img_2' => "string COMMENT 'Картинка 2'",
            'gllr_slides' => "integer COMMENT 'Галерея 1'",
            'gllr_thumbs' => "integer COMMENT 'Галерея 2'",
            'dttm_datetime' => "datetime COMMENT 'Date 1'",
            'dt_date' => "date COMMENT 'Date 2'",
            'tm_time' => "time COMMENT 'Date 3'",
            'dttm_datetime2' => "datetime COMMENT 'Date 4'",
            'wswg_content' => "text COMMENT 'Текст'",
            'wswg_description' => "text COMMENT 'Текст'",
            'msk_field' => "string COMMENT 'Текст по маске'",
            'msk_field2' => "string COMMENT 'Текст по маске 2'",
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "integer COMMENT 'Дата создания'",
            'update_time' => "integer COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
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