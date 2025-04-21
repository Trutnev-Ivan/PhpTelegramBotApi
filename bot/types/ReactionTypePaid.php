<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontypepaid
 */
class ReactionTypePaid implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "paid"
	)
	{
		$this->type = $type;

		if ($this->type != "paid"){
			throw new \InvalidArgumentException("Invalid reaction type '{$this->type}'. Only 'paid' is allowed.");
		}
	}

	public static function fromArray(array $array): ReactionTypePaid
	{
		return new static($array["type"] ?? "paid");
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}