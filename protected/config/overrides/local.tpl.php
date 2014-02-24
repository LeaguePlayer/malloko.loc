<?php
    return array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=magic',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'qwe123',
                'charset' => 'utf8',
                'tablePrefix' => 'tbl_',
            ),
        ),
    );