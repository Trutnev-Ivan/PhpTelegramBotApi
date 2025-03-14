<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputmediaaudio
 */
class InputMediaAudio implements \JsonSerializable
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
	protected ?int $duration;
	protected ?string $performer;
	protected ?string $title;

	public function __construct(
		string $type = "",
		string $media = "",
		?string $thumbnail = null,
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		?int $duration = null,
		?string $performer = null,
		?string $title = null
	)
	{
		$this->type = $type;
		$this->media = $media;
		$this->thumbnail = $thumbnail;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->duration = $duration;
		$this->performer = $performer;
		$this->title = $title;

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be of type " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InputMediaAudio
	{
		return new static(
			$array["type"] ?? "",
			$array["media"] ?? "",
			$array["thumbnail"],
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["duration"],
			$array["performer"],
			$array["title"]
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"media" => $this->media,
			"thumbnail" => $this->thumbnail,
			"caption" => $this->caption,
			"parse_mode" => $this->parseMode,
			"caption_entities" => $this->captionEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities) : [],
			"duration" => $this->duration,
			"performer" => $this->performer,
			"title" => $this->title,
		];
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
	 * @return int|null
	 */
	public function getDuration(): ?int
	{
		return $this->duration;
	}

	/**
	 * @return string|null
	 */
	public function getPerformer(): ?string
	{
		return $this->performer;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}
}