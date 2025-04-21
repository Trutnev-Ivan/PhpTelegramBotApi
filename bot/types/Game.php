<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#game
 */
class Game implements \JsonSerializable
{
	protected string $title;
	protected string $description;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;
	protected ?string $text;
	/**
	 * @var MessageEntity[]
	 */
	protected array $textEntities;
	protected ?Animation $animation;

	public function __construct(
		string $title = "",
		string $description = "",
		array $photo = [],
		?string $text = null,
		array $textEntities = [],
		?Animation $animation = null
	)
	{
		$this->title = $title;
		$this->description = $description;
		$this->photo = $photo;
		$this->text = $text;
		$this->textEntities = $textEntities;
		$this->animation = $animation;

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("photo must be an instance of " . PhotoSize::class);
			}
		}

		foreach ($this->textEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("Text entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): Game
	{
		return new static(
			$array["title"] ?? "",
			$array["description"] ?? "",
			array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photo"] ?? []),
			$array["text"],
			array_map(fn($entity) => MessageEntity::fromArray($entity), $array["text_entities"] ?? []),
			$array["animation"] ? Animation::fromArray($array["animation"]) : null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"title" => $this->title,
			"description" => $this->description,
			"photo" => $this->photo ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photo) : [],
			"text_entities" => $this->textEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->textEntities) : [],
		];

		if (isset($this->text)) {
			$array["text"] = $this->text;
		}
		if (isset($this->animation)) {
			$array["animation"] = $this->animation->jsonSerialize();
		}

		return $array;
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
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getPhoto(): array
	{
		return $this->photo;
	}

	/**
	 * @return string|null
	 */
	public function getText(): ?string
	{
		return $this->text;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getTextEntities(): array
	{
		return $this->textEntities;
	}

	/**
	 * @return Animation|null
	 */
	public function getAnimation(): ?Animation
	{
		return $this->animation;
	}
}