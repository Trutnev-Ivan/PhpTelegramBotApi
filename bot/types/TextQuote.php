<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#textquote
 */
class TextQuote implements \JsonSerializable
{
	protected string $text;
	/**
	 * @var MessageEntity[]
	 */
	protected array $entities = [];
	protected int $position;
	protected bool $isManual;

	/**
	 * @param string $text
	 * @param MessageEntity[] $entities
	 * @param int $position
	 * @param bool $isManual
	 */
	public function __construct(
		string $text = "",
		array $entities = [],
		int $position = 0,
		bool $isManual = false
	)
	{
		$this->text = $text;
		$this->entities = $entities;
		$this->position = $position;
		$this->isManual = $isManual;

		foreach ($this->entities as $entity){
			if (!$entity instanceof MessageEntity){
				throw new \InvalidArgumentException("All entities must be instances of ".MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): TextQuote
	{
		return new static(
			$array["text"] ?? "",
			$array["entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["entities"]) : [],
			$array["position"] ?? 0,
			$array["is_manual"] ?? false,
		);
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function getEntities(): array
	{
		return $this->entities;
	}

	public function getPosition(): int
	{
		return $this->position;
	}

	public function isManual(): bool
	{
		return $this->isManual;
	}

	public function jsonSerialize()
	{
		return [
			"text" => $this->text,
			"entities" => $this->entities ? array_map(fn ($entity) => $entity->jsonSerialize(), $this->entities) : [],
			"position" => $this->position,
			"is_manual" => $this->isManual,
		];
	}
}