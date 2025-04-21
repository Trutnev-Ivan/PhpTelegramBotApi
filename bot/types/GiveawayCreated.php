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
		return new static($array["prize_star_count"]);
	}

	public function jsonSerialize(): array
	{
		$array = [];

		if (isset($this->prizeStarCount)){
			$array["prize_star_count"] = $this->prizeStarCount;
		}

		return $array;
	}

	/**
	 * @return int|null
	 */
	public function getPrizeStarCount(): ?int
	{
		return $this->prizeStarCount;
	}
}