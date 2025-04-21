<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultdocument
 */
class InlineQueryResultDocument implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $title;
	protected ?string $caption;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected string $documentUrl;
	protected string $mimeType;
	protected ?string $description;
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
		string $type = "document",
		string $id = "",
		string $title = "",
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		string $documentUrl = "",
		string $mimeType = "",
		?string $description = null,
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
		$this->title = $title;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->documentUrl = $documentUrl;
		$this->mimeType = $mimeType;
		$this->description = $description;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailWidth = $thumbnailWidth;
		$this->thumbnailHeight = $thumbnailHeight;

		if ($this->type != "document") {
			throw new \InvalidArgumentException("Input media type must be 'document', got {$this->type}");
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultDocument
	{
		return new static(
			$array["type"] ?? "document",
			$array["id"] ?? "",
			$array["title"] ?? "",
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["document_url"] ?? "",
			$array["mime_type"] ?? "",
			$array["description"],
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
			"title" => $this->title,
			"mime_type" => $this->mimeType,
            "document_url" => $this->documentUrl,
		];

		if (isset($this->caption)) {
			$array["caption"] = $this->caption;
		}
		if (isset($this->parseMode)) {
			$array["parse_mode"] = $this->parseMode;
		}
		if (!empty($this->captionEntities)) {
			$array["caption_entities"] = array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities);
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
	 * @return string
	 */
	public function getDocumentUrl(): string
	{
		return $this->documentUrl;
	}

	/**
	 * @return string
	 */
	public function getMimeType(): string
	{
		return $this->mimeType;
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
