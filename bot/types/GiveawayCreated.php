<?php namespace Telegram\Bot\Types;

/**
 * @see http://core.telegram.org/bots/api#giveawaycreated
 */
class GiveawayCreated implements \JsonSerializable
{
	protected ?int $prizeStarCount;

	public function __construct(?int $prizeStarCount)
	{
		$this->prizeStarCount = $prizeStarCount;
	}

	public static function fromArray(array $array): GiveawayCreated
	{
		return new static($array["prize_star_count"] ?? null);
	}

	public function jsonSerialize(): array
	{
		return [
			"prize_star_count" => $this->prizeStarCount,
		];
	}

	/**
	 * @return int|null
	 */
	public function getPrizeStarCount(): ?int
	{
		return $this->prizeStarCount;
	}
}