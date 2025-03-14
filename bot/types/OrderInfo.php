<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class OrderInfo implements \JsonSerializable
{
	protected ?string $name;
	protected ?string $phoneNumber;
	protected ?string $email;
	protected ?ShippingAddress $shippingAddress;

	public function __construct(
		string $name = null,
		string $phoneNumber = null,
		string $email = null,
		ShippingAddress $shippingAddress = null,
	)
	{
		$this->name = $name;
		$this->phoneNumber = $phoneNumber;
		$this->email = $email;
		$this->shippingAddress = $shippingAddress;
	}

	public static function fromArray(array $array): OrderInfo
	{
		return new static(
			$array["name"],
			$array["phone_number"],
			$array["email"],
			$array["shipping_address"] ? ShippingAddress::fromArray($array["shipping_address"]) : null,
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"name" => $this->name,
			"phone_number" => $this->phoneNumber,
			"email" => $this->email,
			"shipping_address" => $this->shippingAddress ? $this->shippingAddress->jsonSerialize() : null,
		];
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @return string|null
	 */
	public function getPhoneNumber(): ?string
	{
		return $this->phoneNumber;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @return ShippingAddress|null
	 */
	public function getShippingAddress(): ?ShippingAddress
	{
		return $this->shippingAddress;
	}
}