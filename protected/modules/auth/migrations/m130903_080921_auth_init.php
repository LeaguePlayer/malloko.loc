<?php
/**
 * Миграция m130903_080921_auth_init
 *
 * @property string $prefix
 */
 
class m130903_080921_auth_init extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{authassignment}}', '{{authitem}}', '{{authitemchild}}');

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
 
        $this->createTable('{{authassignment}}', array(
            'itemname' => 'varchar(64) NOT NULL',
			'userid' => "varchar(64) NOT NULL",
            'bizrule' => "text DEFAULT NULL",
            'data' => "text DEFAULT NULL",
        ), 'ENGINE=InnoDB CHARSET=utf8');
        $this->addPrimaryKey('authassignment_pk', '{{authassignment}}', 'itemname, userid');
        $this->addForeignKey('authassignment_ibfk_1', '{{authassignment}}', 'itemname', '{{authitem}}', 'name', 'CASCADE', 'CASCADE');

        $this->createTable('{{authitem}}', array(
            'name' => 'varchar(64) NOT NULL PRIMARY KEY',
            'type' => "integer NOT NULL",
            'description' => "text DEFAULT NULL",
            'bizrule' => "text DEFAULT NULL",
            'data' => "text DEFAULT NULL",
        ), 'ENGINE=InnoDB CHARSET=utf8');

        $this->createTable('{{authitemchild}}', array(
            'parent' => 'varchar(64) NOT NULL',
            'child' => "varchar(64) NOT NULL",
        ), 'ENGINE=InnoDB CHARSET=utf8');
        $this->addPrimaryKey('authitemchild_pk', '{{authitemchild}}', 'parent, child');
        $this->createIndex('child', '{{authitemchild}}', 'child');
        $this->addForeignKey('authitemchild_ibfk_1', '{{authitemchild}}', 'parent', '{{authitem}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('authitemchild_ibfk_2', '{{authitemchild}}', 'child', '{{authitem}}', 'name', 'CASCADE', 'CASCADE');
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