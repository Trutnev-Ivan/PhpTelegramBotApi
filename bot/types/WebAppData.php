<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#webappdata
 */
class WebAppData implements \JsonSerializable
{
	protected string $data;
	protected string $buttonText;

	public function __construct(
		string $data = "",
		string $buttonText = ""
	)
	{
		$this->data = $data;
		$this->buttonText = $buttonText;
	}

	public static function fromArray(array $array): WebAppData
	{
		return new static(
			$array["data"] ?? "",
			$array["button_text"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"data" => $this->data,
			"button_text" => $this->buttonText,
		];
	}

	/**
	 * @return string
	 */
	public function getData(): string
	{
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getButtonText(): string
	{
		return $this->buttonText;
	}
}