<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#precheckoutquery
 */
class PreCheckoutQuery implements \JsonSerializable
{
	protected string $id;
	protected User $from;
	protected string $currency;
	protected int $totalAmount;
	protected string $invoicePayload;
	protected ?string $shippingOptionId;
	protected ?OrderInfo $orderInfo;

	public function __construct(
		string $id = "",
		User $from = null,
		string $currency = "",
		int $totalAmount = 0,
		string $invoicePayload = "",
		?string $shippingOptionId = null,
		?OrderInfo $orderInfo = null,
	)
	{
		$this->id = $id;
		$this->from = $from;
		$this->currency = $currency;
		$this->totalAmount = $totalAmount;
		$this->invoicePayload = $invoicePayload;
		$this->shippingOptionId = $shippingOptionId;
		$this->orderInfo = $orderInfo;
	}

	public static function fromArray(array $array): PreCheckoutQuery
	{
		return new static(
			$array["id"] ?? "",
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["currency"] ?? "",
			$array["total_amount"] ?? 0,
			$array["invoice_payload"] ?? "",
			$array["shipping_option_id"],
			$array["order_info"] ? OrderInfo::fromArray($array["order_info"]) : null,
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"id" => $this->id,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"currency" => $this->currency,
			"total_amount" => $this->totalAmount,
			"invoice_payload" => $this->invoicePayload,
			"shipping_option_id" => $this->shippingOptionId,
			"order_info" => $this->orderInfo ? $this->orderInfo->jsonSerialize() : null,
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
	public function getCurrency(): string
	{
		return $this->currency;
	}

	/**
	 * @return int
	 */
	public function getTotalAmount(): int
	{
		return $this->totalAmount;
	}

	/**
	 * @return string
	 */
	public function getInvoicePayload(): string
	{
		return $this->invoicePayload;
	}

	/**
	 * @return string|null
	 */
	public function getShippingOptionId(): ?string
	{
		return $this->shippingOptionId;
	}

	/**
	 * @return OrderInfo|null
	 */
	public function getOrderInfo(): ?OrderInfo
	{
		return $this->orderInfo;
	}
}