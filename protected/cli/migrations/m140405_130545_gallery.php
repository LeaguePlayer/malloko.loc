<?php
/**
 * Миграция m140405_130545_gallery
 *
 * @property string $prefix
 */
 
class m140405_130545_gallery extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{gallery}}', '{{gallery_photo}}', '{{entity_gallery}}');
 
    public function safeUp()
    {
        $this->_checkTables();

		$this->createTable( '{{gallery}}', array(
			'id' => 'pk',
			'versions_data' => 'text NOT NULL',
			'name' => 'boolean NOT NULL DEFAULT 1',
			'description' => 'boolean NOT NULL DEFAULT 1',
			'gallery_name' => 'string NOT NULL',
			'alias' => 'string NOT NULL',
		), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci' );

		$this->createTable( '{{gallery_photo}}', array(
			'id' => 'pk',
			'gallery_id' => 'integer NOT NULL',
			'rank' => 'integer NOT NULL DEFAULT 0',
			'name' => 'string NOT NULL',
			'description' => 'text',
			'file_name' => 'string NOT NULL',
			'ext' => 'varchar(10) NOT NULL',
			'main' => 'TINYINT NOT NULL DEFAULT 0'
		), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci' );
		$this->addForeignKey('fk_gallery_photo_gallery1', '{{gallery_photo}}', 'gallery_id',
			'gallery', 'id', 'NO ACTION', 'NO ACTION');

		$this->createTable( '{{entity_gallery}}', array(
			'id' => 'pk',
			'entity_type' => 'string NOT NULL',
			'entity_id' => 'integer NOT NULL DEFAULT 0',
			'gallery_id' => 'boolean NOT NULL DEFAULT 0',
		), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci' );
		$this->createIndex('entity_unuque', '{{entity_gallery}}', 'entity_id, gallery_id, entity_type', true);
    }
 
    public function safeDown()
    {
		$this->dropForeignKey('fk_gallery_photo_gallery1', '{{gallery_photo}}');
		$this->dropIndex('entity_unuque', '{{entity_gallery}}');
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