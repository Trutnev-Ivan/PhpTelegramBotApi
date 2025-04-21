<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 */
class InlineQueryResultMpeg4Gif implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $mpeg4Url;
	protected ?int $mpeg4Width;
	protected ?int $mpeg4Height;
	protected ?int $mpeg4Duration;
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
		string $type = "mpeg4_gif",
		string $id = "",
		string $mpeg4Url = "",
		?int $mpeg4Width = null,
		?int $mpeg4Height = null,
		?int $mpeg4Duration = null,
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
		$this->mpeg4Url = $mpeg4Url;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->mpeg4Width = $mpeg4Width;
		$this->mpeg4Height = $mpeg4Height;
		$this->mpeg4Duration = $mpeg4Duration;
		$this->thumbnailMimeType = $thumbnailMimeType;
		$this->title = $title;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "mpeg4_gif") {
			throw new \InvalidArgumentException("Invalid type provided for InlineQueryResultMpeg4Gif. Must be 'mpeg4_gif', got '{$type}'");
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultMpeg4Gif
	{
		return new static(
			$array["type"] ?? "mpeg4_gif",
			$array["id"] ?? "",
			$array["mpeg4_url"] ?? "",
			$array["mpeg4_width"],
			$array["mpeg4_height"],
			$array["mpeg4_duration"],
			$array["thumbnail_url"] ?? "",
			$array["thumbnail_mime_type"],
			$array["title"],
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"] ?? false,
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"mpeg4_url" => $this->mpeg4Url,
			"thumbnail_url" => $this->thumbnailUrl,
		];

		if (isset($this->mpeg4Width)) {
			$array["mpeg4_width"] = $this->mpeg4Width;
		}
		if (isset($this->mpeg4Height)) {
			$array["mpeg4_height"] = $this->mpeg4Height;
		}
		if (isset($this->mpeg4Duration)) {
			$array["mpeg4_duration"] = $this->mpeg4Duration;
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
		if (!empty($this->captionEntities)) {
			$array["caption_entities"] = array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities);
		}
		if (isset($this->showCaptionAboveMedia)) {
			$array["show_caption_above_media"] = $this->showCaptionAboveMedia;
		}
		if (isset($this->replyMarkup)) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}
		if (isset($this->inputMessageContent)) {
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
	public function getMpeg4Url(): string
	{
		return $this->mpeg4Url;
	}

	/**
	 * @return int|null
	 */
	public function getMpeg4Width(): ?int
	{
		return $this->mpeg4Width;
	}

	/**
	 * @return int|null
	 */
	public function getMpeg4Height(): ?int
	{
		return $this->mpeg4Height;
	}

	/**
	 * @return int|null
	 */
	public function getMpeg4Duration(): ?int
	{
		return $this->mpeg4Duration;
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