<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businessopeninghoursinterval
 */
class BusinessOpeningHoursInterval implements \JsonSerializable
{
	protected int $openingMinute;
	protected int $closingMinute;

	public function __construct(
		int $openingMinute = 0,
		int $closingMinute = 0
	)
	{
		$this->openingMinute = $openingMinute;
		$this->closingMinute = $closingMinute;
	}

	public static function fromArray(array $array): BusinessOpeningHoursInterval
	{
		return new static(
			$array["opening_minute"] ?? 0,
			$array["closing_minute"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"opening_minute" => $this->openingMinute,
			"closing_minute" => $this->closingMinute,
		];
	}

	/**
	 * @return int
	 */
	public function getOpeningMinute(): int
	{
		return $this->openingMinute;
	}

	/**
	 * @return int
	 */
	public function getClosingMinute(): int
	{
		return $this->closingMinute;
	}
}