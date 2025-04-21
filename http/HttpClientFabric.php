<?php namespace Telegram\Http;

use Telegram\Http\Exceptions\ConfigException;
use Telegram\Http\Methods\Base as HttpMethod;

class HttpClientFabric
{
	/**
	 * @throws ConfigException
	 */
	public static function getClient(string $url = "", HttpMethod $method = null): Base
	{
		$httpClient = getenv("HTTP_CLIENT");

		if (!$httpClient){
			return static::getDefaultClient($url, $method);
		}
		
		switch ($httpClient){
			case "curl":
				return new Curl($url, $method);
		}

		throw new ConfigException("Can`t instantiate http client by: ".$httpClient);
	}

	/**
	 * @throws ConfigException
	 */
	protected static function getDefaultClient(string $url = "", HttpMethod $method = null): Base
	{
		if (extension_loaded("curl")){
			return new Curl($url, $method);
		}

		throw new ConfigException("Can`t instantiate default http client");
	}
}