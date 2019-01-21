<?php


//if you are ever questioning if your classes are being included, uncomment the line above and the words "config included" should show at the top of your page.
class Config {
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach ($path as $bit) {
				if(isset($config[$bit])){
					$config = $config[$bit];
				} else {
					return false;
				}
			}

			return $config;
		}

		return false;
	}
}
