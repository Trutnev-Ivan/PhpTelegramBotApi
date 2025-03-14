<?php namespace Telegram\Http;

use Telegram\Http\Methods\Base as HttpMethod;
use Telegram\Http\Methods\Get;

/**
 * Базовый класс для отправки HTTP запросов
 */
abstract class Base
{
	protected HttpMethod $httpMethod;
	/**
	 * @var string[]
	 */
	protected array $headers = [];
	protected string $url = "";
	protected mixed $body;

	public function __construct(string $url = "", HttpMethod $method = null)
	{
		$this->url = $url;
		$this->httpMethod = $method ?? new Get();
	}

	/**
	 * Установить метод HTTP запроса
	 *
	 * @param HttpMethod $method
	 * @return $this
	 */
	public function setMethod(HttpMethod $method): Base
	{
		$this->httpMethod = $method;

		return $this;
	}

	/**
	 * Узнать текущий метод HTTP запроса
	 *
	 * @return HttpMethod
	 */
	public function getMethod(): HttpMethod
	{
		return $this->httpMethod;
	}

	/**
	 * Добавить заголовок в HTTP запрос
	 *
	 * @param string $header
	 * @return $this
	 */
	public function addHeader(string $header): Base
	{
		$this->headers[] = $header;
		return $this;
	}

	/**
	 * Очистить заголовки HTTP запроса
	 *
	 * @return $this
	 */
	public function clearHeaders(): Base
	{
		$this->headers = [];
		return $this;
	}

	/**
	 * Установить URL для HTTP запроса
	 *
	 * @param string $url
	 * @return $this
	 *
	 */
	public function setUrl(string $url): Base
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * Вернуть URL HTTP запроса
	 *
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * Установить тело HTTP запроса
	 *
	 * @param mixed $fields
	 * @return $this
	 */
	public function setBody(mixed $fields): Base
	{
		$this->fields = $fields;
		return $this;
	}

	/**
	 * Получить тело HTTP запроса
	 *
	 * @return mixed
	 */
	public function getBody(): mixed
	{
		return $this->fields;
	}

	/**
	 * Выполнить запрос
	 *
	 * @return mixed
	 */
	abstract public function query(): Response;
}
