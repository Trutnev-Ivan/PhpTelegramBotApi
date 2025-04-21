<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultsbutton
 */
class InlineQueryResultsButton implements \JsonSerializable
{
	protected string $text;
	protected ?WebAppInfo $webApp;
	protected ?string $startParameter;

	public function __construct(
		string $text = "",
		?WebAppInfo $webApp = null,
		?string $startParameter = null,
	)
	{
		$this->text = $text;
		$this->webApp = $webApp;
		$this->startParameter = $startParameter;
	}

	public static function fromArray(array $array): InlineQueryResultsButton
	{
		return new static(
			$array["text"] ?? "",
			$array["web_app"] ? WebAppInfo::fromArray($array["web_app"]) : null,
			$array["start_parameter"],
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"text" => $this->text,
		];

		if ($this->webApp) {
			$array["web_app"] = $this->webApp->jsonSerialize();
		}
		if ($this->startParameter) {
			$array["start_parameter"] = $this->startParameter;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @return WebAppInfo|null
	 */
	public function getWebApp(): ?WebAppInfo
	{
		return $this->webApp;
	}

	/**
	 * @return string|null
	 */
	public function getStartParameter(): ?string
	{
		return $this->startParameter;
	}
}