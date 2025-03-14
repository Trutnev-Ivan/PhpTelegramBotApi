<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businessintro
 */
class BusinessIntro implements \JsonSerializable
{
	protected string $title;
	protected string $message;
	protected Sticker $sticker;

	public function __construct(
		string $title = "",
		string $message = "",
		Sticker $sticker = null
	)
	{
		$this->title = $title;
		$this->message = $message;
		$this->sticker = $sticker;
	}

	public static function fromArray(array $array): BusinessIntro
	{
		return new static(
			$array["title"] ?? "",
			$array["message"] ?? "",
			$array["sticker"] ? Sticker::fromArray($array["sticker"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"title" => $this->title,
			"message" => $this->message,
			"sticker" => $this->sticker ? $this->sticker->jsonSerialize() : null,
		];
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @return Sticker
	 */
	public function getSticker(): Sticker
	{
		return $this->sticker;
	}
}