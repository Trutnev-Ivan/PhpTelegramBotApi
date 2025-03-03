<?php namespace Telegram;

class Loader
{
	public static function includeFiles($dir = __DIR__)
	{
		$files = scandir($dir);

//		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/dir.log', __FILE__ . ':' . __LINE__ . "\n(" . date('Y-m-d H:i:s').")\n" . print_r($files, TRUE) . "\n\n");

		foreach ($files as $file) {

			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/file.log', __FILE__ . ':' . __LINE__ . "\n(" . date('Y-m-d H:i:s').")\n" . print_r($file, TRUE) . "\n\n", FILE_APPEND);

			if ($file == "." || $file == ".."){
				continue;
			}

			if (is_file($dir.DIRECTORY_SEPARATOR.$file)) {
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/__debug.log', __FILE__ . ':' . __LINE__ . "\n(" . date('Y-m-d H:i:s').")\n" . print_r($file, TRUE) . "\n\n", FILE_APPEND);
				require_once $dir . DIRECTORY_SEPARATOR . $file;
			}
			elseif (is_dir($dir.DIRECTORY_SEPARATOR.$file)){
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/__debug.log', __FILE__ . ':' . __LINE__ . "\n(" . date('Y-m-d H:i:s').")\n" . print_r($file, TRUE) . "\n\n", FILE_APPEND);
				static::includeFiles($dir . DIRECTORY_SEPARATOR . $file);
			}
		}
	}
}
