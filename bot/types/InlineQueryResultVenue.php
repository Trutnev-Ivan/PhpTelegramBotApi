<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultvenue
 */
class InlineQueryResultVenue implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected float $latitude;
	protected float $longitude;
	protected string $title;
	protected string $address;
	protected ?string $foursquareId;
	protected ?string $foursquareType;
	protected ?string $googlePlaceId;
	protected ?string $googlePlaceType;
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
		string $type = "venue",
		string $id = "",
		float $latitude = 0,
		float $longitude = 0,
		string $title = "",
		string $address = "",
		?string $foursquareId = null,
		?string $foursquareType = null,
		?string $googlePlaceId = null,
		?string $googlePlaceType = null,
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
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->title = $title;
		$this->address = $address;
		$this->foursquareId = $foursquareId;
		$this->foursquareType = $foursquareType;
		$this->googlePlaceId = $googlePlaceId;
		$this->googlePlaceType = $googlePlaceType;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailWidth = $thumbnailWidth;
		$this->thumbnailHeight = $thumbnailHeight;

		if ($this->type != "venue") {
			throw new \InvalidArgumentException("Invalid type for InlineQueryResultVenue: '{$this->type}'");
		}
	}

	public static function fromArray(array $array): InlineQueryResultVenue
	{
		return new static(
			$array["type"] ?? "venue",
			$array["id"] ?? "",
			$array["latitude"] ?? 0,
			$array["longitude"] ?? 0,
			$array["title"] ?? "",
			$array["address"] ?? "",
			$array["foursquare_id"],
			$array["foursquare_type"],
			$array["google_place_id"],
			$array["google_place_type"],
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
			"latitude" => $this->latitude,
			"longitude" => $this->longitude,
			"title" => $this->title,
			"address" => $this->address,
		];

		if (isset($this->foursquareId)) {
			$array["foursquare_id"] = $this->foursquareId;
		}
		if (isset($this->foursquareType)) {
			$array["foursquare_type"] = $this->foursquareType;
		}
		if (isset($this->googlePlaceId)) {
			$array["google_place_id"] = $this->googlePlaceId;
		}
		if (isset($this->googlePlaceType)) {
			$array["google_place_type"] = $this->googlePlaceType;
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
	 * @return float
	 */
	public function getLatitude(): float
	{
		return $this->latitude;
	}

	/**
	 * @return float
	 */
	public function getLongitude(): float
	{
		return $this->longitude;
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
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @return string|null
	 */
	public function getFoursquareId(): ?string
	{
		return $this->foursquareId;
	}

	/**
	 * @return string|null
	 */
	public function getFoursquareType(): ?string
	{
		return $this->foursquareType;
	}

	/**
	 * @return string|null
	 */
	public function getGooglePlaceId(): ?string
	{
		return $this->googlePlaceId;
	}

	/**
	 * @return string|null
	 */
	public function getGooglePlaceType(): ?string
	{
		return $this->googlePlaceType;
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