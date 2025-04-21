<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#birthdate
 */
class Birthdate implements \JsonSerializable
{
	protected int $day;
	protected int $month;
	protected int $year;

	public function __construct(
		int $day = 0,
		int $month = 0,
		int $year = 0
	)
	{
		$this->day = $day;
		$this->month = $month;
		$this->year = $year;
	}

	public static function fromArray(array $array): Birthdate
	{
		return new static(
			$array["day"] ?? 0,
			$array["month"] ?? 0,
			$array["year"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"day" => $this->day,
			"month" => $this->month,
			"year" => $this->year,
		];
	}

	/**
	 * @return int
	 */
	public function getDay(): int
	{
		return $this->day;
	}

	/**
	 * @return int
	 */
	public function getMonth(): int
	{
		return $this->month;
	}

	/**
	 * @return int
	 */
	public function getYear(): int
	{
		return $this->year;
	}
}