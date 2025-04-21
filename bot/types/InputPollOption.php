<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputpolloption
 */
class InputPollOption implements \JsonSerializable
{
	protected string $text;
	protected ?string $textParseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $textEntities;

	public function __construct(
		string $text = "",
		?string $textParseMode = null,
		array $textEntities = []
	)
	{
		$this->text = $text;
		$this->textParseMode = $textParseMode;
		$this->textEntities = $textEntities;

		foreach ($this->textEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All text entities must be of type " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InputpollOption
	{
		return new static(
			$array["text"] ?? "",
			$array["text_parse_mode"] ?? null,
			$array["text_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["text_entities"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"text" => $this->text,
			"text_entities" => $this->textEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->textEntities) : [],
		];

		if (isset($this->textParseMode)) {
			$array["text_parse_mode"] = $this->textParseMode;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @return string|null
	 */
	public function getTextParseMode(): ?string
	{
		return $this->textParseMode;
	}
}