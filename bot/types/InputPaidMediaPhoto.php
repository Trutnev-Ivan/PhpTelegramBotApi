<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputpaidmediaphoto
 */
class InputPaidMediaPhoto implements \JsonSerializable
{
	protected string $type;
	protected string $media;

	public function __construct(
		string $type = "photo",
		string $media = ""
	)
	{
		$this->type = $type;
		$this->media = $media;

		if ($this->type != "photo"){
			throw new \InvalidArgumentException("Type must be 'photo', got {$this->type}");
		}
	}

	public static function fromArray(array $array): InputPaidMediaPhoto
	{
		return new static(
			$array["type"] ?? "photo",
			$array["media"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"media" => $this->media,
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
	public function getMedia(): string
	{
		return $this->media;
	}
}