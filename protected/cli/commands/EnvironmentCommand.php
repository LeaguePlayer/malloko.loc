<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 15.02.14
 * Time: 17:50
 * To change this template use File | Settings | File Templates.
 */

class EnvironmentCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        print("Текущее окружение: ".$this->getCurrentEnvironment().".\n");
    }

    public function actionCreate($args)
    {
        if ( empty($args) ) {
            print("Ожидается имя окружения.\n");
        }
        $env_name = $args[0];
        $conf_path = Yii::getPathOfAlias('application').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
        $file_name = $conf_path.$env_name.'.env.php';
        if ( is_file($file_name) ) {
            echo "Окружение с таким именем уже существует.\n";
            Yii::app()->end();
        }
        $fp = fopen($file_name, 'w');
        $config_text = "<?php\r".
            "\$mainConfig = require(dirname(__FILE__).'/main.php');\r\r".
            "return array_replace_recursive(\r".
            "\t\$mainConfig,\r".
            "\tarray(\r".
            "\t\t// Здесь можно определить свои настройки\r".
            "\t)\r".
            ");";
        fwrite($fp, $config_text);
        fclose($fp);
        echo "Готово\n";
    }

    protected function getCurrentEnvironment()
    {
        return 'main';
    }
}