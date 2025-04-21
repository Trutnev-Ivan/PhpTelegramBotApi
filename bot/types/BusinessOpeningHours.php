<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businessopeninghours
 */
class BusinessOpeningHours implements \JsonSerializable
{
	protected string $timeZoneName;
	/**
	 * @var BusinessOpeningHoursInterval[]
	 */
	protected array $openingHours;

	public function __construct(
		string $timeZoneName = "",
		array $openingHours = []
	)
	{
		$this->timeZoneName = $timeZoneName;
		$this->openingHours = $openingHours;

		foreach ($this->openingHours as $interval) {
			if (!$interval instanceof BusinessOpeningHoursInterval) {
				throw new \InvalidArgumentException("All opening hours must be instances of " . BusinessOpeningHoursInterval::class);
			}
		}
	}

	public static function fromArray(array $array): BusinessOpeningHours
	{
		return new static(
			$array["time_zone_name"] ?? "",
			$array["opening_hours"] ? array_map(fn($interval) => BusinessOpeningHoursInterval::fromArray($interval), $array["opening_hours"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"time_zone_name" => $this->timeZoneName,
			"opening_hours" => $this->openingHours ? array_map(fn($interval) => $interval->jsonSerialize(), $this->openingHours) : [],
		];
	}

	/**
	 * @return string
	 */
	public function getTimeZoneName(): string
	{
		return $this->timeZoneName;
	}

	/**
	 * @return BusinessOpeningHoursInterval[]
	 */
	public function getOpeningHours(): array
	{
		return $this->openingHours;
	}
}