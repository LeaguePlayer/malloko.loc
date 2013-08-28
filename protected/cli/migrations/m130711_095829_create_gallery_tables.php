<?php

class m130711_095829_create_gallery_tables extends CDbMigration
{
	public function up() {
	  $this->createTable( 'gallery', array(
	      'id' => 'pk',
	      'versions_data' => 'text NOT NULL',
	      'name' => 'boolean NOT NULL DEFAULT 1',
	      'description' => 'boolean NOT NULL DEFAULT 1'
	    ), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci' );

	  $this->createTable( 'gallery_photo', array(
	      'id' => 'pk',
	      'gallery_id' => 'integer NOT NULL',
	      'rank' => 'integer NOT NULL DEFAULT 0',
	      'name' => 'string NOT NULL',
	      'description' => 'text',
	      'file_name' => 'string NOT NULL',
	      'ext' => 'varchar(10) NOT NULL',
	      'main' => 'TINYINT NOT NULL DEFAULT 0'
	    ), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci' );

	  $this->addForeignKey( 'fk_gallery_photo_gallery1', 'gallery_photo', 'gallery_id',
	    'gallery', 'id', 'NO ACTION', 'NO ACTION' );
	}

	public function down() {
	  $this->dropTable( 'gallery_photo' );
	  $this->dropTable( 'gallery' );
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}