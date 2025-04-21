<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputvenuemessagecontent
 */
class InputVenueMessageContent implements \JsonSerializable
{
	protected float $latitude;
	protected float $longitude;
	protected string $title;
	protected string $address;
	protected ?string $foursquareId;
	protected ?string $foursquareType;
	protected ?string $googlePlaceId;
	protected ?string $googlePlaceType;

	public function __construct(
		float $latitude = 0,
		float $longitude = 0,
		string $title = "",
		string $address = "",
		?string $foursquareId = null,
		?string $foursquareType = null,
		?string $googlePlaceId = null,
		?string $googlePlaceType = null
	)
	{
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->title = $title;
		$this->address = $address;
		$this->foursquareId = $foursquareId;
		$this->foursquareType = $foursquareType;
		$this->googlePlaceId = $googlePlaceId;
		$this->googlePlaceType = $googlePlaceType;
	}

	public static function fromArray(array $array): InputVenueMessageContent
	{
		return new static(
			$array["latitude"] ?? 0,
			$array["longitude"] ?? 0,
			$array["title"] ?? "",
			$array["address"] ?? "",
			$array["foursquare_id"],
			$array["foursquare_type"],
			$array["google_place_id"],
			$array["google_place_type"]
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"latitude" => $this->latitude,
			"longitude" => $this->longitude,
			"title" => $this->title,
			"address" => $this->address,
			"foursquare_id" => $this->foursquareId,
			"foursquare_type" => $this->foursquareType,
			"google_place_id" => $this->googlePlaceId,
			"google_place_type" => $this->googlePlaceType,
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
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @return string|null
	 */
	public function getFoursquareId(): ?string
	{
		return $this->foursquareId;
	}

	/**
	 * @return string|null
	 */
	public function getFoursquareType(): ?string
	{
		return $this->foursquareType;
	}

	/**
	 * @return string|null
	 */
	public function getGooglePlaceId(): ?string
	{
		return $this->googlePlaceId;
	}

	/**
	 * @return string|null
	 */
	public function getGooglePlaceType(): ?string
	{
		return $this->googlePlaceType;
	}
}