<?php namespace Telegram;

/**
 * Класс для парсинга и формирования URI
 */
class Uri
{
	// http | https
	protected string $scheme = "";
	protected string $uri = "";
	// параметры в get запросе
	protected array $params;
	// основной url без scheme и GET параметров
	protected string $base = "";

	public function __construct(string $url)
	{
		$this->parseUrl($url);
	}

	protected function parseUrl(string $url){
		$re = "/^((?<scheme>https?):\/\/)?(?<base>[^?]*)\??(?<params>.*)$/";

		preg_match($re, $url, $matches);

		$this->base = $matches["base"];
		$this->scheme = $matches["scheme"] ?? "";
		
		if ($params = $matches["params"]){
			foreach (explode("&", $params) as $param){

				$name = $param;
				$value = "";

				if (strstr($param, "=") !== false){
					[$name, $value] = explode("=", $param);
				}

				$this->params[$name] = $value;
			}
		}
	}

	/**
	 * Формирует URI по установленным параметрам урла
	 *
	 * @return string
	 */
	public function getUri(): string
	{
		$uri = "";

		if ($scheme = $this->getScheme()){
			$uri.= $scheme. "://";
		}

		$uri .= $this->getBase();

		if ($params = $this->getParams()){

			$uri .= "?";

			foreach ($params as $name => $value){
				$uri .= $name."=".$value."&";
			}

			$uri = trim($uri, "&");
		}

		return $uri;
	}

	/**
     * Добавляет новый GET параметр к урлу
     *
     * @param string $name -- название параметра
     * @param string $value -- значение параметра
	 *
	 */
	public function addParam(string $name, string $value): Uri
	{
		$this->params[$name] = $value;
		return $this;
	}

	/**
	 * Возвращает значение GET парометра
	 *
	 * @param string $name -- название параметра
	 * @return string|null
	 */
	public function getParam(string $name): ?string
	{
		return $this->params[$name];
	}

	/**
	 * Удаляет параметр из URI
	 *
	 * @param string $name -- название параметра
	 * @return $this
	 */
	public function removeParam(string $name): Uri
	{
		unset($this->params[$name]);
		return $this;
	}

	/**
	 * Возвращает основную часть URI
	 *
	 * @return string
	 */
	public function getBase(): string
	{
		return $this->base;
	}

	/**
	 * Возвращает scheme URI
	 *
	 * @return string
	 */
	public function getScheme(): string
	{
		return $this->scheme;
	}

	/**
	 * Возвращает все GET параметры URI в формате [CODE => VALUE]
	 *
	 * @return array
	 */
	public function getParams(): array
	{
		return $this->params;
	}

	/**
	 * Очищает все GET параметры
	 *
	 * @return $this
	 */
	public function clearParams(): Uri
	{
		$this->params = [];
		return $this;
	}

	public function isHttps(): bool
	{
		return $this->scheme === "https";
	}
}
