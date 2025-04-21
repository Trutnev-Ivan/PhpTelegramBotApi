<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#successfulpayment
 */
class SuccessfulPayment implements \JsonSerializable
{
	protected string $currency;
	protected int $totalAmount;
	protected string $invoicePayload;
	protected ?int $subscriptionExpirationDate;
	protected bool $isRecurring;
	protected bool $isFirstRecurring;
	protected ?string $shippingOptionId;
	protected ?OrderInfo $orderInfo;
	protected string $telegramPaymentChargeId;
	protected string $providerPaymentChargeId;

	public function __construct(
		string $currency = "",
		int $totalAmount = 0,
		string $invoicePayload = "",
		?int $subscriptionExpirationDate = null,
		bool $isRecurring = false,
		bool $isFirstRecurring = false,
		?string $shippingOptionId = null,
		?OrderInfo $orderInfo = null,
		string $telegramPaymentChargeId = "",
		string $providerPaymentChargeId = ""
	)
	{
		$this->currency = $currency;
		$this->totalAmount = $totalAmount;
		$this->invoicePayload = $invoicePayload;
		$this->subscriptionExpirationDate = $subscriptionExpirationDate;
		$this->isRecurring = $isRecurring;
		$this->isFirstRecurring = $isFirstRecurring;
		$this->shippingOptionId = $shippingOptionId;
		$this->orderInfo = $orderInfo;
		$this->telegramPaymentChargeId = $telegramPaymentChargeId;
		$this->providerPaymentChargeId = $providerPaymentChargeId;
	}

	public static function fromArray(array $array): SuccessfulPayment
	{
		return new static(
			$array["currency"] ?? "",
			$array["total_amount"] ?? 0,
			$array["invoice_payload"] ?? "",
			$array["subscription_expiration_date"] ?? null,
			$array["is_recurring"] ?? false,
			$array["is_first_recurring"] ?? false,
			$array["shipping_option_id"],
			$array["order_info"] ? OrderInfo::fromArray($array["order_info"]) : null,
			$array["telegram_payment_charge_id"] ?? "",
			$array["provider_payment_charge_id"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"currency" => $this->currency,
			"total_amount" => $this->totalAmount,
			"invoice_payload" => $this->invoicePayload,
			"is_recurring" => $this->isRecurring,
			"is_first_recurring" => $this->isFirstRecurring,
			"telegram_payment_charge_id" => $this->telegramPaymentChargeId,
			"provider_payment_charge_id" => $this->providerPaymentChargeId,
		];

		if (isset($this->subscriptionExpirationDate)) {
			$array["subscription_expiration_date"] = $this->subscriptionExpirationDate;
		}
		if (isset($this->shippingOptionId)) {
			$array["shipping_option_id"] = $this->shippingOptionId;
		}
		if (isset($this->orderInfo)) {
			$array["order_info"] = $this->orderInfo->jsonSerialize();
		}

		return $array;
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
	 * @return int|null
	 */
	public function getSubscriptionExpirationDate(): ?int
	{
		return $this->subscriptionExpirationDate;
	}

	/**
	 * @return bool
	 */
	public function isRecurring(): bool
	{
		return $this->isRecurring;
	}

	/**
	 * @return bool
	 */
	public function isFirstRecurring(): bool
	{
		return $this->isFirstRecurring;
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

	/**
	 * @return string
	 */
	public function getTelegramPaymentChargeId(): string
	{
		return $this->telegramPaymentChargeId;
	}

	/**
	 * @return string
	 */
	public function getProviderPaymentChargeId(): string
	{
		return $this->providerPaymentChargeId;
	}
}