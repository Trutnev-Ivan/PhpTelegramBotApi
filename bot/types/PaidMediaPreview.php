<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediapreview
 */
class PaidMediaPreview implements \JsonSerializable
{
	protected string $type;
	protected ?int $width;
	protected ?int $height;
	protected ?int $duration;

	public function __construct(
		string $type,
		?int $width = null,
		?int $height = null,
		?int $duration = null
	)
	{
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;
	}

	public static function fromArray(array $array): PaidMediaPreview
	{
		return new static(
			$array["type"] ?? "",
			$array["width"] ?? null,
			$array["height"] ?? null,
			$array["duration"] ?? null,
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"width" => $this->width,
			"height" => $this->height,
			"duration" => $this->duration,
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
	 * @return int|null
	 */
	public function getWidth(): ?int
	{
		return $this->width;
	}

	/**
	 * @return int|null
	 */
	public function getHeight(): ?int
	{
		return $this->height;
	}

	/**
	 * @return int|null
	 */
	public function getDuration(): ?int
	{
		return $this->duration;
	}
}