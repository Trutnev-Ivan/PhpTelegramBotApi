<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatlocation
 */
class ChatLocation implements \JsonSerializable
{
	protected Location $location;
	protected string $address;

	public function __construct(
		Location $location = null,
		string $address = ""
	)
	{
		$this->location = $location;
		$this->address = $address;
	}

	public static function fromArray(array $array): ChatLocation
	{
		return new static(
			$array["location"] ? Location::fromArray($array["location"]) : null,
			$array["address"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"location" => $this->location ? $this->location->jsonSerialize() : null,
			"address" => $this->address,
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
	public function getAddress(): string
	{
		return $this->address;
	}
}