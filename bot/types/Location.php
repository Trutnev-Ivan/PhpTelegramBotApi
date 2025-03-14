<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#location
 */
class Location implements \JsonSerializable
{
	protected float $latitude;
	protected float $longitude;
	protected ?float $horizontalAccuracy;
	protected ?int $livePeriod;
	protected ?int $heading;
	protected ?int $proximityAlertRadius;

	public function __construct(
		float $latitude = 0,
		float $longitude = 0,
		?float $horizontalAccuracy = null,
		?int $livePeriod = null,
		?int $heading = null,
		?int $proximityAlertRadius = null
	)
	{
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->horizontalAccuracy = $horizontalAccuracy;
		$this->livePeriod = $livePeriod;
		$this->heading = $heading;
		$this->proximityAlertRadius = $proximityAlertRadius;
	}

	public static function fromArray(array $array): Location
	{
		return new static(
			$array["latitude"] ?? 0,
			$array["longitude"] ?? 0,
			$array["horizontal_accuracy"],
			$array["live_period"],
			$array["heading"],
			$array["proximity_alert_radius"]
		);
	}

	public function jsonSerialize()
	{
		return [
			"latitude" => $this->latitude,
			"longitude" => $this->longitude,
			"horizontal_accuracy" => $this->horizontalAccuracy,
			"live_period" => $this->livePeriod,
			"heading" => $this->heading,
			"proximity_alert_radius" => $this->proximityAlertRadius,
		];
	}

	/**
	 * @return float
	 */
	public function getLatitude(): float
	{
		return $this->latitude;
	}

	/**
	 * @return float
	 */
	public function getLongitude(): float
	{
		return $this->longitude;
	}

	/**
	 * @return float|null
	 */
	public function getHorizontalAccuracy(): ?float
	{
		return $this->horizontalAccuracy;
	}

	/**
	 * @return int|null
	 */
	public function getLivePeriod(): ?int
	{
		return $this->livePeriod;
	}

	/**
	 * @return int|null
	 */
	public function getHeading(): ?int
	{
		return $this->heading;
	}

	/**
	 * @return int|null
	 */
	public function getProximityAlertRadius(): ?int
	{
		return $this->proximityAlertRadius;
	}
}