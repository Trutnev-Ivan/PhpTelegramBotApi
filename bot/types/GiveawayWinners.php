<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#giveawaywinners
 */
class GiveawayWinners implements \JsonSerializable
{
	protected Chat $chat;
	protected int $giveawayMessageId;
	protected int $winnersSelectionDate;
	protected int $winnerCount;
	/**
	 * @var User[]
	 */
	protected array $winners;
	protected ?int $additionalChatCount;
	protected ?int $prizeStarCount;
	protected ?int $premiumSubscriptionMonthCount;
	protected ?int $unclaimedPrizeCount;
	protected bool $onlyNewMembers;
	protected bool $wasRefunded;
	protected ?string $prizeDescription;

	public function __construct(
		Chat $chat,
		int $giveawayMessageId,
		int $winnersSelectionDate,
		int $winnerCount,
		array $winners,
		?int $additionalChatCount = null,
		?int $prizeStarCount = null,
		?int $premiumSubscriptionMonthCount = null,
		?int $unclaimedPrizeCount = null,
		bool $onlyNewMembers = false,
		bool $wasRefunded = false,
		?string $prizeDescription = null
	)
	{
		$this->chat = $chat;
		$this->giveawayMessageId = $giveawayMessageId;
		$this->winnersSelectionDate = $winnersSelectionDate;
		$this->winnerCount = $winnerCount;
		$this->winners = $winners;
		$this->additionalChatCount = $additionalChatCount;
		$this->prizeStarCount = $prizeStarCount;
		$this->premiumSubscriptionMonthCount = $premiumSubscriptionMonthCount;
		$this->unclaimedPrizeCount = $unclaimedPrizeCount;
		$this->onlyNewMembers = $onlyNewMembers;
		$this->wasRefunded = $wasRefunded;
		$this->prizeDescription = $prizeDescription;

		foreach ($this->winners as $winner) {
			if (!$winner instanceof User) {
				throw new \InvalidArgumentException("All winners must be instances of " . User::class);
			}
		}
	}

	public static function fromArray(array $array): GiveawayWinners
	{
		return new static(
			Chat::fromArray($array["chat"]),
			$array["giveaway_message_id"] ?? 0,
			$array["winners_selection_date"] ?? 0,
			$array["winner_count"] ?? 0,
			array_map(fn($winner) => User::fromArray($winner), $array["winners"] ?? []),
			$array["additional_chat_count"],
			$array["prize_star_count"],
			$array["premium_subscription_month_count"],
			$array["unclaimed_prize_count"],
			$array["only_new_members"] ?? false,
			$array["was_refunded"] ?? false,
			$array["prize_description"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"chat" => $this->chat->jsonSerialize(),
			"giveaway_message_id" => $this->giveawayMessageId,
			"winners_selection_date" => $this->winnersSelectionDate,
			"winner_count" => $this->winnerCount,
			"winners" => $this->winners ? array_map(fn($winner) => $winner->jsonSerialize(), $this->winners) : [],
			"only_new_members" => $this->onlyNewMembers,
			"was_refunded" => $this->wasRefunded,
		];

		if (isset($this->additionalChatCount)) {
			$array["additional_chat_count"] = $this->additionalChatCount;
		}
		if (isset($this->prizeStarCount)) {
			$array["prize_star_count"] = $this->prizeStarCount;
		}
		if (isset($this->premiumSubscriptionMonthCount)) {
			$array["premium_subscription_month_count"] = $this->premiumSubscriptionMonthCount;
		}
		if (isset($this->unclaimedPrizeCount)) {
			$array["unclaimed_prize_count"] = $this->unclaimedPrizeCount;
		}
		if (isset($this->prizeDescription)) {
			$array["prize_description"] = $this->prizeDescription;
		}

		return $array;
	}

	/**
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return int
	 */
	public function getGiveawayMessageId(): int
	{
		return $this->giveawayMessageId;
	}

	/**
	 * @return int
	 */
	public function getWinnersSelectionDate(): int
	{
		return $this->winnersSelectionDate;
	}

	/**
	 * @return int
	 */
	public function getWinnerCount(): int
	{
		return $this->winnerCount;
	}

	/**
	 * @return User[]
	 */
	public function getWinners(): array
	{
		return $this->winners;
	}

	/**
	 * @return int|null
	 */
	public function getAdditionalChatCount(): ?int
	{
		return $this->additionalChatCount;
	}

	/**
	 * @return int|null
	 */
	public function getPrizeStarCount(): ?int
	{
		return $this->prizeStarCount;
	}

	/**
	 * @return int|null
	 */
	public function getPremiumSubscriptionMonthCount(): ?int
	{
		return $this->premiumSubscriptionMonthCount;
	}

	/**
	 * @return int|null
	 */
	public function getUnclaimedPrizeCount(): ?int
	{
		return $this->unclaimedPrizeCount;
	}

	/**
	 * @return bool
	 */
	public function isOnlyNewMembers(): bool
	{
		return $this->onlyNewMembers;
	}

	/**
	 * @return bool
	 */
	public function wasRefunded(): bool
	{
		return $this->wasRefunded;
	}

	/**
	 * @return string|null
	 */
	public function getPrizeDescription(): ?string
	{
		return $this->prizeDescription;
	}
}