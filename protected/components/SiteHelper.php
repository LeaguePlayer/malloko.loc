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
	
	public static function russianMonth($monthNumber)
	{
		$n = (int) $monthNumber;
		switch ($n) {
			case 1:
				return 'января';
			case 2: 
				return 'февраля';
			case 3: 
				return 'марта';
			case 4: 
				return 'апреля';
			case 5: 
				return 'мая';
			case 6: 
				return 'июня';
			case 7: 
				return 'июля';
			case 8: 
				return 'августа';
			case 9: 
				return 'сентября';
			case 10: 
				return 'октября';
			case 11: 
				return 'ноября';
			case 12: 
				return 'декабря';
		}
	}

	public static function russianDate($datetime = null) {
        if (!$datetime || $datetime == 0)
            return '';
            
		if (is_numeric($datetime) ) {
			$timestamp = $datetime;
		} else if (is_string($datetime)) {
			$timestamp = strtotime($datetime);
        } else {
			$timestamp = time();
		}
		$date = explode(".", date("d.m.Y", $timestamp));
		$m = self::russianMonth($date[1]);
		return $date[0] . '&nbsp;' . $m . '&nbsp;' . $date[2];
	}

	public static function sendMail($subject,$message,$to='',$from='')
    {
        if($to=='') $to = Yii::app()->params['adminEmail'];
        if($from=='') $from = 'no-reply@torsim.ru';
        $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
        return mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }
}