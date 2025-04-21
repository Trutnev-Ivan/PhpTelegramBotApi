<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputmediaanimation
 */
class InputMediaAnimation implements \JsonSerializable
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
	protected bool $showCaptionAboveMedia;
	protected ?int $width;
	protected ?int $height;
	protected ?int $duration;
	protected bool $hasSpoiler;

	public function __construct(
		string $type = "animation",
		string $media = "",
		?string $thumbnail = null,
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		bool $showCaptionAboveMedia = false,
		?int $width = null,
		?int $height = null,
		?int $duration = null,
		bool $hasSpoiler = false
	)
	{
		$this->type = $type;
		$this->media = $media;
		$this->thumbnail = $thumbnail;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;
		$this->hasSpoiler = $hasSpoiler;

		if ($this->type != "animation"){
			throw new \InvalidArgumentException("Invalid media type. Must be 'animation', got {$this->type}");
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InputMediaAnimation
	{
		return new static(
			$array["type"] ?? "animation",
			$array["media"] ?? "",
			$array["thumbnail"],
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"] ?? false,
			$array["width"],
			$array["height"],
			$array["duration"],
			$array["has_spoiler"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"media" => $this->media,
			"show_caption_above_media" => $this->showCaptionAboveMedia,
			"has_spoiler" => $this->hasSpoiler,
			"caption_entities" => $this->captionEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities) : [],
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
		if (isset($this->width)) {
			$array["width"] = $this->width;
		}
		if (isset($this->height)) {
			$array["height"] = $this->height;
		}
		if (isset($this->duration)) {
			$array["duration"] = $this->duration;
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
	public function isShowCaptionAboveMedia(): bool
	{
		return $this->showCaptionAboveMedia;
	}

	/**
	 * @return int|null
	 */
	public function getWidth(): ?int
	{
		return $this->width;
	}

	/**
	 * @return int|null
	 */
	public function getHeight(): ?int
	{
		return $this->height;
	}

	/**
	 * @return int|null
	 */
	public function getDuration(): ?int
	{
		return $this->duration;
	}

	/**
	 * @return bool
	 */
	public function hasSpoiler(): bool
	{
		return $this->hasSpoiler;
	}
}