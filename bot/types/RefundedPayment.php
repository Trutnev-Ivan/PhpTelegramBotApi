<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#refundedpayment
 */
class RefundedPayment implements \JsonSerializable
{
	protected string $currency;
	protected int $totalAmount;
	protected string $invoicePayload;
	protected string $telegramPaymentChargeId;
	protected ?string $providerPaymentChargeId;

	public function __construct(
		string $currency = "",
		int $totalAmount = 0,
		string $invoicePayload = "",
		string $telegramPaymentChargeId = "",
		?string $providerPaymentChargeId = null,
	)
	{
		$this->currency = $currency;
		$this->totalAmount = $totalAmount;
		$this->invoicePayload = $invoicePayload;
		$this->telegramPaymentChargeId = $telegramPaymentChargeId;
		$this->providerPaymentChargeId = $providerPaymentChargeId;
	}

	public static function fromArray(array $array): RefundedPayment
	{
		return new static(
			$array["currency"] ?? "",
			$array["total_amount"] ?? 0,
			$array["invoice_payload"] ?? "",
			$array["telegram_payment_charge_id"] ?? "",
			$array["provider_payment_charge_id"]
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"currency" => $this->currency,
			"total_amount" => $this->totalAmount,
			"invoice_payload" => $this->invoicePayload,
			"telegram_payment_charge_id" => $this->telegramPaymentChargeId,
			"provider_payment_charge_id" => $this->providerPaymentChargeId,
		];
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
	 * @return string
	 */
	public function getTelegramPaymentChargeId(): string
	{
		return $this->telegramPaymentChargeId;
	}

	/**
	 * @return string|null
	 */
	public function getProviderPaymentChargeId(): ?string
	{
		return $this->providerPaymentChargeId;
	}
}