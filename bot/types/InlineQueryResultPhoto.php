<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultphoto
 */
class InlineQueryResultPhoto implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $photoUrl;
	protected string $thumbnailUrl;
	protected ?int $photoWidth;
	protected ?int $photoHeight;
	protected ?string $title;
	protected ?string $description;
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
		string $type = "photo",
		string $id = "",
		string $photoUrl = "",
		string $thumbnailUrl = "",
		?int $photoWidth = null,
		?int $photoHeight = null,
		?string $title = null,
		?string $description = null,
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
		$this->photoUrl = $photoUrl;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->photoWidth = $photoWidth;
		$this->photoHeight = $photoHeight;
		$this->title = $title;
		$this->description = $description;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "photo") {
			throw new \InvalidArgumentException("Invalid type. Must be 'photo', got {$this->type}");
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultPhoto
	{
		return new static(
			$array["type"] ?? "photo",
			$array["id"] ?? "",
			$array["photo_url"] ?? "",
			$array["thumbnail_url"] ?? "",
			$array["photo_width"],
			$array["photo_height"],
			$array["title"],
			$array["description"],
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn ($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"],
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"photo_url" => $this->photoUrl,
			"thumbnail_url" => $this->thumbnailUrl,
		];

		if (isset($this->photoWidth)){
			$array["photo_width"] = $this->photoWidth;
		}
		if (isset($this->photoHeight)){
            $array["photo_height"] = $this->photoHeight;
        }
		if (isset($this->title)){
            $array["title"] = $this->title;
        }
		if (isset($this->description)){
            $array["description"] = $this->description;
        }
		if (isset($this->caption)){
            $array["caption"] = $this->caption;
        }
		if (isset($this->parseMode)){
            $array["parse_mode"] = $this->parseMode;
        }
		if (!empty($this->captionEntities)){
            $array["caption_entities"] = array_map(fn ($entity) => $entity->jsonSerialize(), $this->captionEntities);
        }
		if (isset($this->showCaptionAboveMedia)){
            $array["show_caption_above_media"] = $this->showCaptionAboveMedia;
        }
		if (isset($this->replyMarkup)){
            $array["reply_markup"] = $this->replyMarkup->jsonSerialize();
        }
		if (isset($this->inputMessageContent)){
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
	public function getPhotoUrl(): string
	{
		return $this->photoUrl;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl(): string
	{
		return $this->thumbnailUrl;
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
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
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
	 * @return InputTextMessageContent | InputLocationMessageContent | InputVenueMessageContent | InputContactMessageContent | InputInvoiceMessageContent | null
	 */
	public function getInputMessageContent(): InputTextMessageContent | InputLocationMessageContent | InputVenueMessageContent | InputContactMessageContent | InputInvoiceMessageContent | null
	{
		return $this->inputMessageContent;
	}
}