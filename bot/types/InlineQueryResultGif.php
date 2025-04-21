<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultgif
 */
class InlineQueryResultGif implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $gifUrl;
	protected ?int $gifWidth;
	protected ?int $gifHeight;
	protected ?int $gifDuration;
	protected string $thumbnailUrl;
	protected ?string $thumbnailMimeType;
	protected ?string $title;
	protected ?string $caption;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected bool $showCaptionAboveMedia;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	| null $inputMessageContent;

	public function __construct(
		string $type = "gif",
		string $id = "",
		string $gifUrl = "",
		?int $gifWidth = null,
		?int $gifHeight = null,
		?int $gifDuration = null,
		string $thumbnailUrl = "",
		?string $thumbnailMimeType = null,
		?string $title = null,
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		bool $showCaptionAboveMedia = false,
		?InlineKeyboardMarkup $replyMarkup = null,
		InputTextMessageContent
		| InputLocationMessageContent
		| InputVenueMessageContent
		| InputContactMessageContent
		| InputInvoiceMessageContent
		| null $inputMessageContent = null
	)
	{
		$this->type = $type;
		$this->id = $id;
		$this->gifUrl = $gifUrl;
		$this->gifWidth = $gifWidth;
		$this->gifHeight = $gifHeight;
		$this->gifDuration = $gifDuration;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailMimeType = $thumbnailMimeType;
		$this->title = $title;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "gif") {
			throw new \InvalidArgumentException("Invalid media type. Must be 'gif', got {$this->type}");
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("Invalid caption entity. Must be of type MessageEntity");
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultGif
	{
		return new static(
			$array["type"] ?? "gif",
			$array["id"] ?? "",
			$array["gif_url"] ?? "",
			$array["gif_width"],
			$array["gif_height"],
			$array["gif_duration"],
			$array["thumbnail_url"] ?? "",
			$array["thumbnail_mime_type"],
			$array["title"],
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"] ?? false,
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			InputMessageContent::fromArray($array["input_message_content"])
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"gif_url" => $this->gifUrl,
		];

		if (isset($this->gifWidth)) {
			$array["gif_width"] = $this->gifWidth;
		}
		if (isset($this->gifHeight)) {
			$array["gif_height"] = $this->gifHeight;
		}
		if (isset($this->gifDuration)) {
			$array["gif_duration"] = $this->gifDuration;
		}
		if (isset($this->thumbnailUrl)) {
			$array["thumbnail_url"] = $this->thumbnailUrl;
		}
		if (isset($this->thumbnailMimeType)) {
			$array["thumbnail_mime_type"] = $this->thumbnailMimeType;
		}
		if (isset($this->title)) {
			$array["title"] = $this->title;
		}
		if (isset($this->caption)) {
			$array["caption"] = $this->caption;
		}
		if (isset($this->parseMode)) {
			$array["parse_mode"] = $this->parseMode;
		}
		if ($this->captionEntities) {
			$array["caption_entities"] = array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities);
		}
		if (isset($this->showCaptionAboveMedia)) {
			$array["show_caption_above_media"] = $this->showCaptionAboveMedia;
		}
		if ($this->replyMarkup) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}
		if ($this->inputMessageContent) {
			$array["input_message_content"] = $this->inputMessageContent->jsonSerialize();
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
	public function getGifUrl(): string
	{
		return $this->gifUrl;
	}

	/**
	 * @return int|null
	 */
	public function getGifWidth(): ?int
	{
		return $this->gifWidth;
	}

	/**
	 * @return int|null
	 */
	public function getGifHeight(): ?int
	{
		return $this->gifHeight;
	}

	/**
	 * @return int|null
	 */
	public function getGifDuration(): ?int
	{
		return $this->gifDuration;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl(): string
	{
		return $this->thumbnailUrl;
	}

	/**
	 * @return string|null
	 */
	public function getThumbnailMimeType(): ?string
	{
		return $this->thumbnailMimeType;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function getCaption(): ?string
	{
		return $this->caption;
	}

	/**
	 * @return string|null
	 */
	public function getParseMode(): ?string
	{
		return $this->parseMode;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getCaptionEntities(): array
	{
		return $this->captionEntities;
	}

	/**
	 * @return bool
	 */
	public function isShowCaptionAboveMedia(): bool
	{
		return $this->showCaptionAboveMedia;
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
}