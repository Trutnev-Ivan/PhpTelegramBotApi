<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultcontact
 */
class InlineQueryResultContact implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $phoneNumber;
	protected string $firstName;
	protected ?string $lastName;
	protected ?string $vcard;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	| null $inputMessageContent;
	protected ?string $thumbnailUrl;
	protected ?int $thumbnailWidth;
	protected ?int $thumbnailHeight;

	public function __construct(
		string $type = "contact",
		string $id = "",
		string $phoneNumber = "",
		string $firstName = "",
		?string $lastName = null,
		?string $vcard = null,
		?InlineKeyboardMarkup $replyMarkup = null,
		InputTextMessageContent
		| InputLocationMessageContent
		| InputVenueMessageContent
		| InputContactMessageContent
		| InputInvoiceMessageContent
		| null $inputMessageContent = null,
		?string $thumbnailUrl = null,
		?int $thumbnailWidth = null,
		?int $thumbnailHeight = null
	)
	{
		$this->type = $type;
		$this->id = $id;
		$this->phoneNumber = $phoneNumber;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->vcard = $vcard;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailWidth = $thumbnailWidth;
		$this->thumbnailHeight = $thumbnailHeight;

		if ($this->type != "contact") {
			throw new \InvalidArgumentException("Invalid type for InlineQueryResultContact: '{$this->type}'");
		}
	}

	public static function fromArray(array $array): InlineQueryResultContact
	{
		return new static(
			$array["type"] ?? "contact",
			$array["id"] ?? "",
			$array["phone_number"] ?? "",
			$array["first_name"] ?? "",
			$array["last_name"],
			$array["vcard"],
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null,
			$array["thumbnail_url"],
			$array["thumbnail_width"],
			$array["thumbnail_height"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"phone_number" => $this->phoneNumber,
			"first_name" => $this->firstName,
		];

		if (isset($this->lastName)) {
			$array["last_name"] = $this->lastName;
		}
		if (isset($this->vcard)) {
			$array["vcard"] = $this->vcard;
		}
		if (isset($this->replyMarkup)) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}
		if (isset($this->inputMessageContent)) {
			$array["input_message_content"] = $this->inputMessageContent->jsonSerialize();
		}
		if (isset($this->thumbnailUrl)) {
			$array["thumbnail_url"] = $this->thumbnailUrl;
		}
		if (isset($this->thumbnailWidth)) {
			$array["thumbnail_width"] = $this->thumbnailWidth;
		}
		if (isset($this->thumbnailHeight)) {
			$array["thumbnail_height"] = $this->thumbnailHeight;
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
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getPhoneNumber(): string
	{
		return $this->phoneNumber;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @return string|null
	 */
	public function getVcard(): ?string
	{
		return $this->vcard;
	}

	/**
	 * @return InlineKeyboardMarkup|null
	 */
	public function getReplyMarkup(): ?InlineKeyboardMarkup
	{
		return $this->replyMarkup;
	}

	/**
	 * @return InputContactMessageContent|InputInvoiceMessageContent|InputLocationMessageContent|InputTextMessageContent|InputVenueMessageContent|null
	 */
	public function getInputMessageContent(): InputTextMessageContent|InputContactMessageContent|InputVenueMessageContent|InputInvoiceMessageContent|InputLocationMessageContent|null
	{
		return $this->inputMessageContent;
	}

	/**
	 * @return string|null
	 */
	public function getThumbnailUrl(): ?string
	{
		return $this->thumbnailUrl;
	}

	/**
	 * @return int|null
	 */
	public function getThumbnailWidth(): ?int
	{
		return $this->thumbnailWidth;
	}

	/**
	 * @return int|null
	 */
	public function getThumbnailHeight(): ?int
	{
		return $this->thumbnailHeight;
	}
}