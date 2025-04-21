<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputmediadocument
 */
class InputMediaDocument implements \JsonSerializable
{
	protected string $type;
	protected string $media;
	protected ?string $thumbnail;
	protected ?string $caption;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected bool $disableContentTypeDetection;

	public function __construct(
		string $type = "document",
		string $media = "",
		?string $thumbnail = null,
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		bool $disableContentTypeDetection = false
	)
	{
		$this->type = $type;
		$this->media = $media;
		$this->thumbnail = $thumbnail;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->disableContentTypeDetection = $disableContentTypeDetection;

		if ($this->type != "document"){
			throw new \InvalidArgumentException("Type must be 'document', got {$this->type}");
		}
		
		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InputMediaDocument
	{
		return new static(
			$array["type"] ?? "document",
			$array["media"] ?? "",
			$array["thumbnail"],
			$array["caption"],
			$array["parse_mode"],
			array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"] ?? []),
			$array["disable_content_type_detection"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"media" => $this->media,
			"caption_entities" => $this->captionEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities) : [],
			"disable_content_type_detection" => $this->disableContentTypeDetection,
		];

		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail;
		}
		if (isset($this->caption)) {
			$array["caption"] = $this->caption;
		}
		if (isset($this->parseMode)) {
			$array["parse_mode"] = $this->parseMode;
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
	public function getMedia(): string
	{
		return $this->media;
	}

	/**
	 * @return string|null
	 */
	public function getThumbnail(): ?string
	{
		return $this->thumbnail;
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
	public function isDisableContentTypeDetection(): bool
	{
		return $this->disableContentTypeDetection;
	}
}