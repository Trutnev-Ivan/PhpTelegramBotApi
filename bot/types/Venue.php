<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#venue
 */
class Venue implements \JsonSerializable
{
	protected Location $location;
	protected string $title;
	protected string $address;
	protected ?string $foursquareId;
	protected ?string $foursquareType;
	protected ?string $googlePlaceId;
	protected ?string $googlePlaceType;

	public function __construct(
		Location $location,
		string $title = "",
		string $address = "",
		?string $foursquareId = null,
		?string $foursquareType = null,
		?string $googlePlaceId = null,
		?string $googlePlaceType = null
	)
	{
		$this->location = $location;
		$this->title = $title;
		$this->address = $address;
		$this->foursquareId = $foursquareId;
		$this->foursquareType = $foursquareType;
		$this->googlePlaceId = $googlePlaceId;
		$this->googlePlaceType = $googlePlaceType;
	}

	public static function fromArray(array $array): Venue
	{
		return new static(
			Location::fromArray($array["location"]),
			$array["title"] ?? "",
			$array["address"] ?? "",
			$array["foursquare_id"] ?? null,
			$array["foursquare_type"] ?? null,
			$array["google_place_id"] ?? null,
			$array["google_place_type"] ?? null
		);
	}

	public function jsonSerialize()
	{
		return [
			"location" => $this->location ? $this->location->jsonSerialize() : null,
			"title" => $this->title,
			"address" => $this->address,
			"foursquare_id" => $this->foursquareId,
			"foursquare_type" => $this->foursquareType,
			"google_place_id" => $this->googlePlaceId,
			"google_place_type" => $this->googlePlaceType,
		];
	}

	/**
	 * @return Location
	 */
	public function getLocation(): Location
	{
		return $this->location;
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