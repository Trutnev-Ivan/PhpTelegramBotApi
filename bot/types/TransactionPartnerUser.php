<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartneruser
 */
class TransactionPartnerUser implements \JsonSerializable
{
	protected string $type;
	protected User $user;
	protected ?AffiliateInfo $affiliate;
	protected ?string $invoicePayload;
	protected ?int $subscriptionPeriod;
	/**
	 * @var (PaidMediaPhoto|PaidMediaVideo|PaidMediaPreview)[]
	 */
	protected array $paidMedia;
	protected ?string $paidMediaPayload;
	protected ?Gift $gift;

	public function __construct(
		string $type = "user",
		User $user = null,
		?AffiliateInfo $affiliate = null,
		?string $invoicePayload = null,
		?int $subscriptionPeriod = null,
		array $paidMedia = [],
		?string $paidMediaPayload = null,
		?Gift $gift = null
	)
	{
		$this->type = $type;
		$this->user = $user;
		$this->affiliate = $affiliate;
		$this->invoicePayload = $invoicePayload;
		$this->subscriptionPeriod = $subscriptionPeriod;
		$this->paidMedia = $paidMedia;
		$this->paidMediaPayload = $paidMediaPayload;
		$this->gift = $gift;

		if ($this->type != "user") {
			throw new \InvalidArgumentException("Invalid type provided for TransactionPartnerUser. Must be 'user', got {$this->type}'");
		}

		foreach ($this->paidMedia as $paidMedia) {
			if (!$paidMedia instanceof PaidMedia) {
				throw new \InvalidArgumentException("All paid media must be instances of PaidMedia");
			}
		}
	}

	public static function fromArray(array $array): TransactionPartnerUser
	{
		return new static(
			$array["type"] ?? "user",
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["affiliate"] ? AffiliateInfo::fromArray($array["affiliate"]) : null,
			$array["invoice_payload"],
			$array["subscription_period"],
			$array["paid_media"] ? array_map(fn($media) => PaidMedia::fromArray($media), $array["paid_media"]) : [],
			$array["paid_media_payload"],
			$array["gift"] ? Gift::fromArray($array["gift"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"user" => $this->user->jsonSerialize(),
		];

		if (isset($this->affiliate)) {
			$array["affiliate"] = $this->affiliate->jsonSerialize();
		}
		if (isset($this->invoicePayload)) {
			$array["invoice_payload"] = $this->invoicePayload;
		}
		if (isset($this->subscriptionPeriod)) {
			$array["subscription_period"] = $this->subscriptionPeriod;
		}
		if ($this->paidMedia) {
			$array["paid_media"] = array_map(fn($media) => $media->jsonSerialize(), $this->paidMedia);
		}
		if (isset($this->paidMediaPayload)) {
			$array["paid_media_payload"] = $this->paidMediaPayload;
		}
		if (isset($this->gift)) {
			$array["gift"] = $this->gift->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return AffiliateInfo|null
	 */
	public function getAffiliate(): ?AffiliateInfo
	{
		return $this->affiliate;
	}

	/**
	 * @return string|null
	 */
	public function getInvoicePayload(): ?string
	{
		return $this->invoicePayload;
	}

	/**
	 * @return int|null
	 */
	public function getSubscriptionPeriod(): ?int
	{
		return $this->subscriptionPeriod;
	}

	/**
	 * @return (PaidMediaPhoto|PaidMediaVideo|PaidMediaPreview)[]
	 */
	public function getPaidMedia(): array
	{
		return $this->paidMedia;
	}

	/**
	 * @return string|null
	 */
	public function getPaidMediaPayload(): ?string
	{
		return $this->paidMediaPayload;
	}

	/**
	 * @return Gift|null
	 */
	public function getGift(): ?Gift
	{
		return $this->gift;
	}
}