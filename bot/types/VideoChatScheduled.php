<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#videochatscheduled
 */
class VideoChatScheduled implements \JsonSerializable
{
	protected int $startDate;

	public function __construct(
		int $startDate = 0
	)
	{
		$this->startDate = $startDate;
	}

	public static function fromArray(array $array): VideoChatScheduled
	{
		return new static($array["start_date"] ?? 0);
	}

	public function jsonSerialize(): array
	{
		return [
			"start_date" => $this->startDate,
		];
	}

	/**
	 * @return int
	 */
	public function getStartDate(): int
	{
		return $this->startDate;
	}
}