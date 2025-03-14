<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#giveawaycompleted
 */
class GiveawayCompleted implements \JsonSerializable
{
	protected int $winnerCount;
	protected ?int $unclaimedPrizeCount;
	protected ?Message $giveawayMessage;
	protected bool $isStarGiveaway;

	public function __construct(
		int $winnerCount = 0,
		?int $unclaimedPrizeCount = null,
		?Message $giveawayMessage = null,
		bool $isStarGiveaway = false
	)
	{
		$this->winnerCount = $winnerCount;
		$this->unclaimedPrizeCount = $unclaimedPrizeCount;
		$this->giveawayMessage = $giveawayMessage;
		$this->isStarGiveaway = $isStarGiveaway;
	}

	public static function fromArray(array $array): GiveawayCompleted
	{
		return new static(
			$array["winner_count"] ?? 0,
			$array["unclaimed_prize_count"] ?? null,
			$array["giveaway_message"] ? Message::fromArray($array["giveaway_message"]) : null,
			$array["is_star_giveaway"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"winner_count" => $this->winnerCount,
			"unclaimed_prize_count" => $this->unclaimedPrizeCount,
			"giveaway_message" => $this->giveawayMessage ? $this->giveawayMessage->jsonSerialize() : null,
			"is_star_giveaway" => $this->isStarGiveaway,
		];
	}

	/**
	 * @return int
	 */
	public function getWinnerCount(): int
	{
		return $this->winnerCount;
	}

	/**
	 * @return int|null
	 */
	public function getUnclaimedPrizeCount(): ?int
	{
		return $this->unclaimedPrizeCount;
	}

	/**
	 * @return Message|null
	 */
	public function getGiveawayMessage(): ?Message
	{
		return $this->giveawayMessage;
	}

	/**
	 * @return bool
	 */
	public function isStarGiveaway(): bool
	{
		return $this->isStarGiveaway;
	}
}