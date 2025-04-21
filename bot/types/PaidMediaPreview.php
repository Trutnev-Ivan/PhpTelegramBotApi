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
		string $type = "preview",
		?int $width = null,
		?int $height = null,
		?int $duration = null
	)
	{
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;

		if ($this->type != "preview"){
			throw new \InvalidArgumentException("Invalid PaidMediaPreview type. Must be 'preview', got {$this->type}");
		}
	}

	public static function fromArray(array $array): PaidMediaPreview
	{
		return new static(
			$array["type"] ?? "preview",
			$array["width"] ?? null,
			$array["height"] ?? null,
			$array["duration"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
		];

		if (isset($this->width)){
			$array["width"] = $this->width;
		}
		if (isset($this->height)){
			$array["height"] = $this->height;
		}
		if (isset($this->duration)){
			$array["duration"] = $this->duration;
		}

		return $array;
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