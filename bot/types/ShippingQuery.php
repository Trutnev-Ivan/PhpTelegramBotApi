<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#shippingquery
 */
class ShippingQuery implements \JsonSerializable
{
	protected string $id;
	protected User $from;
	protected string $invoicePayload;
	protected ShippingAddress $shippingAddress;

	public function __construct(
		string $id = "",
		User $from = null,
		string $invoicePayload = "",
		ShippingAddress $shippingAddress = null
	)
	{
		$this->id = $id;
		$this->from = $from;
		$this->invoicePayload = $invoicePayload;
		$this->shippingAddress = $shippingAddress;
	}

	public static function fromArray(array $array): ShippingQuery
	{
		return new static(
			$array["id"] ?? "",
			User::fromArray($array["from"]),
			$array["invoice_payload"] ?? "",
			ShippingAddress::fromArray($array["shipping_address"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"id" => $this->id,
			"from" => $this->from->jsonSerialize(),
			"invoice_payload" => $this->invoicePayload,
			"shipping_address" => $this->shippingAddress->jsonSerialize(),
		];
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return User
	 */
	public function getFrom(): User
	{
		return $this->from;
	}

	/**
	 * @return string
	 */
	public function getInvoicePayload(): string
	{
		return $this->invoicePayload;
	}

	/**
	 * @return ShippingAddress
	 */
	public function getShippingAddress(): ShippingAddress
	{
		return $this->shippingAddress;
	}
}