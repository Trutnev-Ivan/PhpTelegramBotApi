<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultlocation
 */
class InlineQueryResultLocation implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected float $latitude;
	protected float $longitude;
	protected string $title;
	protected ?float $horizontalAccuracy;
	protected ?int $livePeriod;
	protected ?int $heading;
	protected ?int $proximityAlertRadius;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent|InputLocationMessageContent|InputVenueMessageContent|InputContactMessageContent|InputInvoiceMessageContent|null $inputMessageContent;
	protected ?string $thumbnailUrl;
	protected ?int $thumbnailWidth;
	protected ?int $thumbnailHeight;

	public function __construct(
		string $type = "location",
		string $id = "",
		float $latitude = 0.0,
		float $longitude = 0.0,
		string $title = "",
		?float $horizontalAccuracy = null,
		?int $livePeriod = null,
		?int $heading = null,
		?int $proximityAlertRadius = null,
		?InlineKeyboardMarkup $replyMarkup = null,
		InputTextMessageContent|InputLocationMessageContent|InputVenueMessageContent|InputContactMessageContent|InputInvoiceMessageContent|null $inputMessageContent = null,
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
		$this->horizontalAccuracy = $horizontalAccuracy;
		$this->livePeriod = $livePeriod;
		$this->heading = $heading;
		$this->proximityAlertRadius = $proximityAlertRadius;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailWidth = $thumbnailWidth;
		$this->thumbnailHeight = $thumbnailHeight;

		if ($this->type != "location") {
			throw new \InvalidArgumentException("Invalid type: '{$this->type}'. Expected 'location'.");
		}
	}

	public static function fromArray(array $array): InlineQueryResultLocation
	{
		return new static(
			$array["type"] ?? "location",
			$array["id"] ?? "",
			$array["latitude"] ?? 0.0,
			$array["longitude"] ?? 0.0,
			$array["title"] ?? "",
			$array["horizontal_accuracy"],
			$array["live_period"],
			$array["heading"],
			$array["proximity_alert_radius"],
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
		];

		if (isset($this->horizontalAccuracy)) {
			$array["horizontal_accuracy"] = $this->horizontalAccuracy;
		}
		if (isset($this->livePeriod)) {
			$array["live_period"] = $this->livePeriod;
		}
		if (isset($this->heading)) {
			$array["heading"] = $this->heading;
		}
		if (isset($this->proximityAlertRadius)) {
			$array["proximity_alert_radius"] = $this->proximityAlertRadius;
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
	 * @return float|null
	 */
	public function getHorizontalAccuracy(): ?float
	{
		return $this->horizontalAccuracy;
	}

	/**
	 * @return int|null
	 */
	public function getLivePeriod(): ?int
	{
		return $this->livePeriod;
	}

	/**
	 * @return int|null
	 */
	public function getHeading(): ?int
	{
		return $this->heading;
	}

	/**
	 * @return int|null
	 */
	public function getProximityAlertRadius(): ?int
	{
		return $this->proximityAlertRadius;
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