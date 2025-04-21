<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#videochatended
 */
class VideoChatEnded implements \JsonSerializable
{
	protected int $duration;

	public function __construct(
		int $duration = 0
	){
		$this->duration = $duration;
	}

	public static function fromArray(array $array): VideoChatEnded
	{
		return new static($array["duration"]);
	}

	public function jsonSerialize(): array
	{
		return [
			"duration" => $this->duration,
		];
	}
}