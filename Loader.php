<?php namespace Telegram;

class Loader
{
	public static function includeFiles($dir = __DIR__)
	{
		$files = scandir($dir);

		foreach ($files as $file) {

			if ($file == "." || $file == ".." || is_file($file) && pathinfo($file, PATHINFO_EXTENSION) != "php"){
				continue;
			}

			if (is_file($dir.DIRECTORY_SEPARATOR.$file)) {
				require_once $dir . DIRECTORY_SEPARATOR . $file;
			}
			elseif (is_dir($dir.DIRECTORY_SEPARATOR.$file)){
				static::includeFiles($dir . DIRECTORY_SEPARATOR . $file);
			}
		}
	}
}
