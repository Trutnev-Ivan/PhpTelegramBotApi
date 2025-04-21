<?php namespace Telegram;

class Loader
{
	/**
	 * @param $dir -- directory to load
	 * @return void
	 */
	public static function load(string $dir = __DIR__)
	{
		static::includeFiles($dir);
		static::initEnv($dir);
	}

	public static function includeFiles(string $dir = __DIR__)
	{
		$dir = rtrim($dir, DIRECTORY_SEPARATOR);
		$files = scandir($dir);

		foreach ($files as $file) {

			if ($file == "." || $file == ".." || is_file($dir.DIRECTORY_SEPARATOR.$file) && pathinfo($dir.DIRECTORY_SEPARATOR.$file, PATHINFO_EXTENSION) != "php" || $file == "hooks") {
				continue;
			}

			if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
				require_once $dir . DIRECTORY_SEPARATOR . $file;
			} elseif (is_dir($dir . DIRECTORY_SEPARATOR . $file)) {
				static::includeFiles($dir . DIRECTORY_SEPARATOR . $file);
			}
		}
	}

	public static function initEnv(string $dir = __DIR__)
	{
		$envFile = $dir . DIRECTORY_SEPARATOR . ".env";

		if (file_exists($envFile)) {
			$env = file_get_contents($envFile);
			$lines = explode("\n", $env);

			foreach ($lines as $line) {
				preg_match("/([^#]+)\=(.*)/", $line, $matches);

				if (isset($matches[2])) {
					putenv(trim($line));
				}
			}
		}
	}
}
