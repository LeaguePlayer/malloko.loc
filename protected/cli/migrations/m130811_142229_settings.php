<?php
/**
 * Миграция m130811_142229_settings
 *
 * @property string $prefix
 */
 
class m130811_142229_settings extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{settings}}','{{settings_types}}','{{settings_string}}','{{settings_text}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{settings}}', array(
			'id' => 'pk',
            'label' => 'string NOT NULL COMMENT "Название"',
            'name' => 'string NOT NULL COMMENT "Уникальное имя"',
            'type' => 'string COMMENT "Тип поля"',
            'type_id' => 'int COMMENT "Значение Типа"',
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createIndex('uniq_name', '{{settings}}', 'name', true);

        $this->createTable('{{settings_types}}', array(
            'id' => 'pk',
            'name' => 'string NOT NULL COMMENT "Название"',
            'type' => 'string NOT NULL COMMENT "Тип"'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createIndex('uniq_type', '{{settings_types}}', 'type', true);

        //table values
        $this->createTable('{{settings_string}}', array(
            'id' => 'pk',
            'value' => 'string NOT NULL COMMENT "Значение"',
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{settings_text}}', array(
            'id' => 'pk',
            'value' => 'text NOT NULL COMMENT "Значение"',
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //default types
        $this->insert('{{settings_types}}', array(
            'name' => 'Строка',
            'type' => 'string'
        ));
        $this->insert('{{settings_types}}', array(
            'name' => 'Длинный текст',
            'type' => 'text'
        ));
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