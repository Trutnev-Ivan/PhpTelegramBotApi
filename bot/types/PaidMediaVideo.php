<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediavideo
 */
class PaidMediaVideo implements \JsonSerializable
{
	protected string $type;
	protected Video $video;

	public function __construct(
		string $type,
		Video $video
	)
	{
		$this->type = $type;
		$this->video = $video;
	}

	public static function fromArray(array $array): PaidMediaVideo
	{
		return new static(
			$array["type"] ?? "",
			$array["video"] ? Video::fromArray($array["video"]) : null
		);
	}

	public function jsonSerialize()
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