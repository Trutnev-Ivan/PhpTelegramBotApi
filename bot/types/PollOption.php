<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#polloption
 */
class PollOption implements \JsonSerializable
{
	protected string $text;
	/**
	 * @var MessageEntity[]
	 */
	protected array $textEntities;
	protected int $voterCount;

	public function __construct(
		string $text,
		array $textEntities = [],
		int $voterCount = 0
	)
	{
		$this->text = $text;
		$this->textEntities = $textEntities;
		$this->voterCount = $voterCount;

		foreach ($this->textEntities as $textEntity) {
			if (!$textEntity instanceof MessageEntity){
				throw new \InvalidArgumentException("All text entities must be instances of ".MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): PollOption
	{
		return new static(
			$array["text"] ?? "",
			$array["text_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["text_entities"]) : [],
			$array["voter_count"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"text" => $this->text,
			"text_entities" => $this->textEntities ? array_map(fn ($entity) => $entity->jsonSerialize(),$this->textEntities) : [],
			"voter_count" => $this->voterCount,
		];
	}
}