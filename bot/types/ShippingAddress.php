<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#shippingaddress
 */
class ShippingAddress implements \JsonSerializable
{
	protected string $countryCode;
	protected string $state;
	protected string $city;
	protected string $streetLine1;
	protected string $streetLine2;
	protected string $postCode;

	public function __construct(
		string $countryCode = "",
		string $state = "",
		string $city = "",
		string $streetLine1 = "",
		string $streetLine2 = "",
		string $postCode = ""
	)
	{
		$this->countryCode = $countryCode;
		$this->state = $state;
		$this->city = $city;
		$this->streetLine1 = $streetLine1;
		$this->streetLine2 = $streetLine2;
		$this->postCode = $postCode;
	}

	public static function fromArray(array $array): ShippingAddress
	{
		return new static(
			$array["country_code"] ?? "",
			$array["state"] ?? "",
			$array["city"] ?? "",
			$array["street_line1"] ?? "",
			$array["street_line2"] ?? "",
			$array["post_code"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"country_code" => $this->countryCode,
			"state" => $this->state,
			"city" => $this->city,
			"street_line1" => $this->streetLine1,
			"street_line2" => $this->streetLine2,
			"post_code" => $this->postCode,
		];
	}

	/**
	 * @return string
	 */
	public function getCountryCode(): string
	{
		return $this->countryCode;
	}

	/**
	 * @return string
	 */
	public function getState(): string
	{
		return $this->state;
	}

	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function getStreetLine1(): string
	{
		return $this->streetLine1;
	}

	/**
	 * @return string
	 */
	public function getStreetLine2(): string
	{
		return $this->streetLine2;
	}

	/**
	 * @return string
	 */
	public function getPostCode(): string
	{
		return $this->postCode;
	}
}