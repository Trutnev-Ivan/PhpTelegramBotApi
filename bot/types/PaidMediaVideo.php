<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediavideo
 */
class PaidMediaVideo implements \JsonSerializable
{
	protected string $type;
	protected Video $video;

	public function __construct(
		string $type = "video",
		Video $video = null
	)
	{
		$this->type = $type;
		$this->video = $video;

		if ($this->type != "video"){
			throw new \InvalidArgumentException("Type must be 'video', got {$this->type}");
		}
	}

	public static function fromArray(array $array): PaidMediaVideo
	{
		return new static(
			$array["type"] ?? "video",
			Video::fromArray($array["video"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"video" => $this->video->jsonSerialize(),
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
	 * @return Video
	 */
	public function getVideo(): Video
	{
		return $this->video;
	}
}