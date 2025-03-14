<?php namespace Telegram\Http;

/**
 * DTO класс для HTTP ответа
 */
class Response
{
	protected array $headers = [];
	protected int $code;
	protected string $status = "";
	protected string $body = "";

	public function __construct(
		int $code = 200,
		string $status = "",
		string $body = "",
		array $headers = []
	)
	{
		$this->code = $code;
		$this->status = $status;
		$this->body = $body;
		$this->headers = $headers;
	}

	/**
	 * Код ответа
	 *
	 * @return int
	 */
	public function getStatusCode(): int
	{
		return $this->code;
	}

	/**
	 * Тело ответа
	 *
	 * @return string
	 */
	public function getBody(): string
	{
		return $this->body;
	}

	/**
	 * Статус ответа
	 *
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * Заголовки ответа
	 *
	 * @return array
	 */
	public function getHeaders(): array
	{
		return $this->headers;
	}
}
