<?php

class EnvironmentCommand extends CConsoleCommand
{
    public function run($args)
    {
        if ( empty($args) ) {
            print("Текущее окружение: \n");
            Yii::app()->end();
        }
        $env_name = $args[0];

        if ( $env_name === 'clear' ) {
            unlink( Yii::getPathOfAlias('application').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'overrides'.DIRECTORY_SEPARATOR.'environment.php' );
            Yii::app()->end();
        }

        $source_path = Yii::getPathOfAlias('application').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment'.DIRECTORY_SEPARATOR;
        $dest_path = Yii::getPathOfAlias('application').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'overrides'.DIRECTORY_SEPARATOR;

        $source_config = $source_path.$env_name.'.php';
        if ( !file_exists($source_config) || !copy($source_config, $dest_path.'environment.php') ) {
            echo "Не удалось скопировать $source_config ...\n";
            Yii::app()->end();
        }

        $source_params = $source_path.'params-'.$env_name.'.php';
        if ( !file_exists($source_params) || !copy($source_params, $dest_path.'params.php') ) {
            echo "Не удалось скопировать $source_path.$env_name.php ...\n";
            Yii::app()->end();
        }

        echo "Готово\n";
    }
}