<?php

class SiteHelper {

	public static function translit($str) {
		$tr = array(
			"А" => "a", "Б" => "b", "В" => "v", "Г" => "g",
			"Д" => "d", "Е" => "e", "Ж" => "j", "З" => "z", "И" => "i",
			"Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
			"О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
			"У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
			"Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
			"Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
			"в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
			"з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
			"м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
			"с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
			"ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
			"ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
			" " => "_", "." => "_", "/" => "-", "(" => "", ")" => "",
		);
		return strtr($str, $tr);
	}

	public static function pluralize($n, $arr) {

		$index = $n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
		if ($arr) {
			return $n . ' ' . $arr[$index];
		} else {
			return $n;
		}
	}

	public static function scanNameModels($folderAlias = 'application.models', $parentClass = 'EActiveRecord') {
		$path = Yii::getPathOfAlias($folderAlias);
		$files = scandir($path);
		$ret = array();
		foreach ($files as $file) {
			if (($pos = strpos($file, '.php')) === false)
				continue;
			$modelClass = substr($file, 0, -4);
			try {
				if (get_parent_class($modelClass) === $parentClass) {
					$ret[] = $modelClass;
				}
			} catch (Exception $e) {
				continue;
			}
		}
		return $ret;
	}

	public static function genUniqueKey($length = 9, $salt = '') {
		$string = 'abcdefghijlklmnopqrstuvwxyzABCDEFGHIJLKLMNOPQRSTUVWXYZ1234567890';
		$result = '';
		$n = strlen($string);
		for ($i = 0; $i < $length; $i++) {
			$result .= $string[rand(0, $n)];
		}
		if ($length and $length > 0)
			return substr(md5($result . $salt . time()), 0, $length);
		else
			return substr(md5($result . time()), 0);
	}

	public static function russianDate($datetime = null) {
		if (is_integer($datetime) ) {
			$timestamp = $datetime;
		} else if (is_string($datetime)) {
			$timestamp = strtotime($datetime);
		} else {
			$timestamp = time();
		}
		$date = explode(".", date("d.m.Y", $timestamp));
		switch ($date[1]) {
			case 1: $m = 'января';
				break;
			case 2: $m = 'февраля';
				break;
			case 3: $m = 'марта';
				break;
			case 4: $m = 'апреля';
				break;
			case 5: $m = 'мая';
				break;
			case 6: $m = 'июня';
				break;
			case 7: $m = 'июля';
				break;
			case 8: $m = 'августа';
				break;
			case 9: $m = 'сентября';
				break;
			case 10: $m = 'октября';
				break;
			case 11: $m = 'ноября';
				break;
			case 12: $m = 'декабря';
				break;
		}
		return $date[0] . '&nbsp;' . $m . '&nbsp;' . $date[2];
	}

}