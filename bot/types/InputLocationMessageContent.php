<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputlocationmessagecontent
 */
class InputLocationMessageContent implements \JsonSerializable
{
	protected float $latitude;
	protected float $longitude;
	protected ?float $horizontalAccuracy;
	protected ?int $livePeriod;
	protected ?int $heading;
	protected ?int $proximityAlertRadius;

	public function __construct(
		float $latitude,
		float $longitude,
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

	public static function fromArray(array $array): InputLocationMessageContent
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

	public function jsonSerialize(): array
	{
		$array = [
			"latitude" => $this->latitude,
			"longitude" => $this->longitude,
		];

		if (isset($this->horizontalAccuracy)) {
			$array["horizontal_accuracy"] = $this->horizontalAccuracy;
		}
		if (isset($this->livePeriod)) {
			$array["live_period"] = $this->livePeriod;
		}
		if (isset($this->heading)) {
			$array["heading"] = $this->heading;
		}
		if (isset($this->proximityAlertRadius)) {
			$array["proximity_alert_radius"] = $this->proximityAlertRadius;
		}

		return $array;
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