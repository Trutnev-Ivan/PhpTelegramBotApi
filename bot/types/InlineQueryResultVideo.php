<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultvideo
 */
class InlineQueryResultVideo implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $videoUrl;
	protected string $mimeType;
	protected string $thumbnailUrl;
	protected string $title;
	protected ?string $caption;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected bool $showCaptionAboveMedia;
	protected ?int $videoWidth;
	protected ?int $videoHeight;
	protected ?int $videoDuration;
	protected ?string $description;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	| null $inputMessageContent;

	public function __construct(
		string $type = "video",
		string $id = "",
		string $videoUrl = "",
		string $mimeType = "",
		string $thumbnailUrl = "",
		string $title = "",
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		bool $showCaptionAboveMedia = false,
		?int $videoWidth = null,
		?int $videoHeight = null,
		?int $videoDuration = null,
		?string $description = null,
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
		$this->videoUrl = $videoUrl;
		$this->mimeType = $mimeType;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->title = $title;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->videoWidth = $videoWidth;
		$this->videoHeight = $videoHeight;
		$this->videoDuration = $videoDuration;
		$this->description = $description;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "video") {
			throw new \InvalidArgumentException("Input media must be of type 'video', got {$this->type}");
		}

		foreach ($this->captionEntities as $entity) {
			if (!($entity instanceof MessageEntity)) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultVideo
	{
		return new static(
			$array["type"] ?? "video",
			$array["id"] ?? "",
			$array["video_url"] ?? "",
			$array["mime_type"] ?? "",
			$array["thumbnail_url"] ?? "",
			$array["title"] ?? "",
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"] ?? false,
			$array["video_width"],
			$array["video_height"],
			$array["video_duration"],
			$array["description"],
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"video_url" => $this->videoUrl,
			"mime_type" => $this->mimeType,
			"thumbnail_url" => $this->thumbnailUrl,
			"title" => $this->title,
		];

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
		if (isset($this->videoWidth)) {
			$array["video_width"] = $this->videoWidth;
		}
		if (isset($this->videoHeight)) {
			$array["video_height"] = $this->videoHeight;
		}
		if (isset($this->videoDuration)) {
			$array["video_duration"] = $this->videoDuration;
		}
		if (isset($this->description)) {
			$array["description"] = $this->description;
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
	public function getVideoUrl(): string
	{
		return $this->videoUrl;
	}

	/**
	 * @return string
	 */
	public function getMimeType(): string
	{
		return $this->mimeType;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl(): string
	{
		return $this->thumbnailUrl;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
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
	 * @return int|null
	 */
	public function getVideoWidth(): ?int
	{
		return $this->videoWidth;
	}

	/**
	 * @return int|null
	 */
	public function getVideoHeight(): ?int
	{
		return $this->videoHeight;
	}

	/**
	 * @return int|null
	 */
	public function getVideoDuration(): ?int
	{
		return $this->videoDuration;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
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