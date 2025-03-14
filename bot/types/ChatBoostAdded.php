<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostadded
 */
class ChatBoostAdded implements \JsonSerializable
{
	protected int $boostCount;

	public function __construct(int $boostCount)
	{
		$this->boostCount = $boostCount;
	}

	public static function fromArray(array $array): ChatBoostAdded
	{
		return new static($array["boost_count"]);
	}

	public function jsonSerialize()
	{
		return [
			"boost_count" => $this->boostCount
		];
	}

	/**
	 * @return int
	 */
	public function getBoostCount(): int
	{
		return $this->boostCount;
	}
}