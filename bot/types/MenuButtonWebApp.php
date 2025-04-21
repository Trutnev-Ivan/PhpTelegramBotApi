<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#menubuttonwebapp
 */
class MenuButtonWebApp implements \JsonSerializable
{
	protected string $type;
	protected string $text;
	protected WebAppInfo $webApp;

	public function __construct(
		string $type = "web_app",
		string $text = "",
		WebAppInfo $webApp = null
	)
	{
		$this->type = $type;
		$this->text = $text;
		$this->webApp = $webApp;
	}

	public static function fromArray(array $array): MenuButtonWebApp
	{
		return new static(
			$array["type"] ?? "web_app",
			$array["text"] ?? "",
			WebAppInfo::fromArray($array["web_app"]),
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"text" => $this->text,
			"web_app" => $this->webApp->jsonSerialize(),
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @return WebAppInfo
	 */
	public function getWebApp(): WebAppInfo
	{
		return $this->webApp;
	}
}