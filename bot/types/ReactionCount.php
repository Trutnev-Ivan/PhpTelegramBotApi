<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactioncount
 */
class ReactionCount implements \JsonSerializable
{
	protected ReactionType $type;
	protected int $totalCount;

	public function __construct(
		ReactionType $type,
		int $totalCount = 0
	)
	{
		$this->type = $type;
		$this->totalCount = $totalCount;
	}

	public static function fromArray(array $array): ReactionCount
	{
		return new static(
			$array["type"] ? ReactionType::fromArray($array["type"]) : null,
			$array["total_count"] ?? 0,
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type ? $this->type->jsonSerialize() : null,
			"total_count" => $this->totalCount,
		];
	}

	/**
	 * @return ReactionType
	 */
	public function getType(): ReactionType
	{
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getTotalCount(): int
	{
		return $this->totalCount;
	}
}