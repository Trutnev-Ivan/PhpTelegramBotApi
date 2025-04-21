<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputinvoicemessagecontent
 */
class InputInvoiceMessageContent implements \JsonSerializable
{
	protected string $title;
	protected string $description;
	protected string $payload;
	protected ?string $providerToken;
	protected string $currency;
	/**
	 * @var LabeledPrice[]
	 */
	protected array $prices;
	protected ?int $maxTipAmount;
	/**
	 * @var int[]
	 */
	protected array $suggestedTipAmounts;
	protected ?string $providerData;
	protected ?string $photoUrl;
	protected ?int $photoSize;
	protected ?int $photoWidth;
	protected ?int $photoHeight;
	protected bool $needName;
	protected bool $needPhoneNumber;
	protected bool $needEmail;
	protected bool $needShippingAddress;
	protected bool $sendPhoneNumberToProvider;
	protected bool $sendEmailToProvider;
	protected bool $isFlexible;

	public function __construct(
		string $title,
		string $description,
		string $payload,
		?string $providerToken = null,
		string $currency = "",
		array $prices = [],
		?int $maxTipAmount = null,
		array $suggestedTipAmounts = [],
		?string $providerData = null,
		?string $photoUrl = null,
		?int $photoSize = null,
		?int $photoWidth = null,
		?int $photoHeight = null,
		bool $needName = true,
		bool $needPhoneNumber = true,
		bool $needEmail = true,
		bool $needShippingAddress = true,
		bool $sendPhoneNumberToProvider = true,
		bool $sendEmailToProvider = true,
		bool $isFlexible = false,
	)
	{
		$this->title = $title;
		$this->description = $description;
		$this->payload = $payload;
		$this->providerToken = $providerToken;
		$this->currency = $currency;
		$this->prices = $prices;
		$this->maxTipAmount = $maxTipAmount;
		$this->suggestedTipAmounts = $suggestedTipAmounts;
		$this->providerData = $providerData;
		$this->photoUrl = $photoUrl;
		$this->photoSize = $photoSize;
		$this->photoWidth = $photoWidth;
		$this->photoHeight = $photoHeight;
		$this->needName = $needName;
		$this->needPhoneNumber = $needPhoneNumber;
		$this->needEmail = $needEmail;
		$this->needShippingAddress = $needShippingAddress;
		$this->sendPhoneNumberToProvider = $sendPhoneNumberToProvider;
		$this->sendEmailToProvider = $sendEmailToProvider;
		$this->isFlexible = $isFlexible;

		foreach ($this->prices as $price) {
			if (!$price instanceof LabeledPrice) {
				throw new \InvalidArgumentException("All prices must be instances of " . LabeledPrice::class);
			}
		}

		foreach ($this->suggestedTipAmounts as $suggestedTipAmount) {
			if (!is_int($suggestedTipAmount)) {
				throw new \InvalidArgumentException("All suggested tip amounts must be integers");
			}
		}
	}

	public static function fromArray(array $array): InputInvoiceMessageContent
	{
		return new static(
			$array["title"] ?? "",
			$array["description"] ?? "",
			$array["payload"] ?? "",
			$array["providerToken"],
			$array["currency"] ?? "",
			$array["prices"] ? array_map(fn($price) => LabeledPrice::fromArray($price), $array["prices"]) : [],
			$array["max_tip_amount"],
			$array["suggested_tip_amounts"] ?? [],
			$array["provider_data"],
			$array["photo_url"],
			$array["photo_size"],
			$array["photo_width"],
			$array["photo_height"],
			$array["need_name"] ?? false,
			$array["need_phone_number"] ?? false,
			$array["need_email"] ?? false,
			$array["need_shipping_address"] ?? false,
			$array["send_phone_number_to_provider"] ?? false,
			$array["send_email_to_provider"] ?? false,
			$array["is_flexible"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"title" => $this->title,
			"description" => $this->description,
			"payload" => $this->payload,
			"currency" => $this->currency,
			"prices" => array_map(fn($price) => $price->jsonSerialize(), $this->prices),
			"suggested_tip_amounts" => $this->suggestedTipAmounts,
			"need_name" => $this->needName,
			"need_phone_number" => $this->needPhoneNumber,
			"need_email" => $this->needEmail,
			"need_shipping_address" => $this->needShippingAddress,
			"send_phone_number_to_provider" => $this->sendPhoneNumberToProvider,
			"send_email_to_provider" => $this->sendEmailToProvider,
			"is_flexible" => $this->isFlexible,
		];

		if (isset($this->providerToken)) {
			$array["provider_token"] = $this->providerToken;
		}
		if (isset($this->maxTipAmount)) {
			$array["max_tip_amount"] = $this->maxTipAmount;
		}
		if (isset($this->providerData)) {
			$array["provider_data"] = $this->providerData;
		}
		if (isset($this->photoUrl)) {
			$array["photo_url"] = $this->photoUrl;
		}
		if (isset($this->photoSize)) {
			$array["photo_size"] = $this->photoSize;
		}
		if (isset($this->photoWidth)) {
			$array["photo_width"] = $this->photoWidth;
		}
		if (isset($this->photoHeight)) {
			$array["photo_height"] = $this->photoHeight;
		}

		return $array;
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
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getPayload(): string
	{
		return $this->payload;
	}

	/**
	 * @return string|null
	 */
	public function getProviderToken(): ?string
	{
		return $this->providerToken;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->currency;
	}

	/**
	 * @return LabeledPrice[]
	 */
	public function getPrices(): array
	{
		return $this->prices;
	}

	/**
	 * @return int|null
	 */
	public function getMaxTipAmount(): ?int
	{
		return $this->maxTipAmount;
	}

	/**
	 * @return int[]
	 */
	public function getSuggestedTipAmounts(): array
	{
		return $this->suggestedTipAmounts;
	}

	/**
	 * @return string|null
	 */
	public function getProviderData(): ?string
	{
		return $this->providerData;
	}

	/**
	 * @return string|null
	 */
	public function getPhotoUrl(): ?string
	{
		return $this->photoUrl;
	}

	/**
	 * @return int|null
	 */
	public function getPhotoSize(): ?int
	{
		return $this->photoSize;
	}

	/**
	 * @return int|null
	 */
	public function getPhotoWidth(): ?int
	{
		return $this->photoWidth;
	}

	/**
	 * @return int|null
	 */
	public function getPhotoHeight(): ?int
	{
		return $this->photoHeight;
	}

	/**
	 * @return bool
	 */
	public function isNeedName(): bool
	{
		return $this->needName;
	}

	/**
	 * @return bool
	 */
	public function isNeedPhoneNumber(): bool
	{
		return $this->needPhoneNumber;
	}

	/**
	 * @return bool
	 */
	public function isNeedEmail(): bool
	{
		return $this->needEmail;
	}

	/**
	 * @return bool
	 */
	public function isNeedShippingAddress(): bool
	{
		return $this->needShippingAddress;
	}

	/**
	 * @return bool
	 */
	public function isSendPhoneNumberToProvider(): bool
	{
		return $this->sendPhoneNumberToProvider;
	}

	/**
	 * @return bool
	 */
	public function isSendEmailToProvider(): bool
	{
		return $this->sendEmailToProvider;
	}

	/**
	 * @return bool
	 */
	public function isFlexible(): bool
	{
		return $this->isFlexible;
	}
}