<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsourcegiveaway
 */
class ChatBoostSourceGiveaway implements \JsonSerializable
{
	protected string $source;
	protected int $giveawayMessageId;
	protected ?User $user;
	protected ?int $prizeStarCount;
	protected bool $isUnclaimed;

	public function __construct(
		string $source = "",
		int $giveawayMessageId = 0,
		?User $user = null,
		?int $prizeStarCount = null,
		bool $isUnclaimed = false
	)
	{
		$this->source = $source;
		$this->giveawayMessageId = $giveawayMessageId;
		$this->user = $user;
		$this->prizeStarCount = $prizeStarCount;
		$this->isUnclaimed = $isUnclaimed;
	}

	public static function fromArray(array $array): ChatBoostSourceGiveaway
	{
		return new static(
			$array["source"] ?? "",
			$array["giveaway_message_id"] ?? 0,
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["prize_star_count"] ?? null,
			$array["is_unclaimed"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"source" => $this->source,
			"giveaway_message_id" => $this->giveawayMessageId,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
			"prize_star_count" => $this->prizeStarCount,
			"is_unclaimed" => $this->isUnclaimed,
		];
	}

	/**
	 * @return string
	 */
	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * @return int
	 */
	public function getGiveawayMessageId(): int
	{
		return $this->giveawayMessageId;
	}

	/**
	 * @return User|null
	 */
	public function getUser(): ?User
	{
		return $this->user;
	}

	/**
	 * @return int|null
	 */
	public function getPrizeStarCount(): ?int
	{
		return $this->prizeStarCount;
	}

	/**
	 * @return bool
	 */
	public function isUnclaimed(): bool
	{
		return $this->isUnclaimed;
	}
}