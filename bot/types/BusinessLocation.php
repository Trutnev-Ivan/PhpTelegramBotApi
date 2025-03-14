<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businesslocation
 */
class BusinessLocation implements \JsonSerializable
{
	protected string $address;
	protected ?Location $location;

	public function __construct(
		string $address = "",
		Location $location = null
	)
	{
		$this->address = $address;
		$this->location = $location;
	}

	public static function fromArray(array $array): BusinessLocation
	{
		return new static(
			$array["address"] ?? "",
			$array["location"] ? Location::fromArray($array["location"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"address" => $this->address,
			"location" => $this->location ? $this->location->jsonSerialize() : null,
		];
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @return Location|null
	 */
	public function getLocation(): ?Location
	{
		return $this->location;
	}
}