<?php
/**
 * Миграция m130830_115831_email_initial
 *
 * @property string $prefix
 */
 
class m130830_115831_email_initial extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{email_templates}}', '{{email_vars}}', '{{email_recipients}}');
 
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
 
        $this->createTable('{{email_templates}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Название шаблона'",
            'alias' => "string COMMENT 'Идентификатор шаблона'",
            'subject' => "string NOT NULL COMMENT 'Тема письма'",
            'from' => "string NOT NULL COMMENT 'От кого'",
            'send_interval' => "integer COMMENT 'Периодичность рассылки'",
            'last_send_date' => "datetime COMMENT 'Дата последней рассылки'",
            'send_status' => "tinyint COMMENT 'Статус рассылки'",
            'content' => "text NOT NULL COMMENT 'Шаблон письма'",
            'create_time' => "integer COMMENT 'Дата создания'",
            'update_time' => "integer COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{email_vars}}', array(
            'id' => 'pk', // auto increment
            'name' => "string NOT NULL COMMENT 'Имя переменной'",
            'value' => "text COMMENT 'Значение переменной'",
            'template_id' => "integer DEFAULT 0 COMMENT 'Ссылка на шаблон'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{email_recipients}}', array(
            'id' => 'pk', // auto increment
            'email' => "string NOT NULL COMMENT 'email получателя'",
            'template_id' => "integer DEFAULT 0 COMMENT 'Ссылка на шаблон'",
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