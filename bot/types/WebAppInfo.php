<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#webappinfo
 */
class WebAppInfo implements \JsonSerializable
{
	protected string $url;

	public function __construct(string $url)
	{
		$this->url = $url;
	}

	public static function fromArray(array $array): WebAppInfo
	{
		return new static($array["url"]);
	}

	public function jsonSerialize(): array
	{
		return [
			"url" => $this->url
		];
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}
}