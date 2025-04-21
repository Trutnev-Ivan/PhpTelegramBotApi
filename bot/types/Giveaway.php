<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#giveaway
 */
class Giveaway implements \JsonSerializable
{
	/**
	 * @var Chat[]
	 */
	protected array $chats;
	protected int $winnersSelectionDate;
	protected int $winnerCount;
	protected bool $onlyNewMembers;
	protected bool $hasPublicWinners;
	protected ?string $prizeDescription;
	/**
	 * @var string []
	 */
	protected array $countryCodes;
	protected ?int $prizeStarCount;
	protected ?int $premiumSubscriptionMonthCount;

	public function __construct(
		array $chats = [],
		int $winnersSelectionDate = 0,
		int $winnerCount = 0,
		bool $onlyNewMembers = false,
		bool $hasPublicWinners = false,
		?string $prizeDescription = null,
		array $countryCodes = [],
		?int $prizeStarCount = null,
		?int $premiumSubscriptionMonthCount = null,
	)
	{
		$this->chats = $chats;
		$this->winnersSelectionDate = $winnersSelectionDate;
		$this->winnerCount = $winnerCount;
		$this->onlyNewMembers = $onlyNewMembers;
		$this->hasPublicWinners = $hasPublicWinners;
		$this->prizeDescription = $prizeDescription;
		$this->countryCodes = $countryCodes;
		$this->prizeStarCount = $prizeStarCount;
		$this->premiumSubscriptionMonthCount = $premiumSubscriptionMonthCount;

		foreach ($this->chats as $chat) {
			if (!$chat instanceof Chat) {
				throw new \InvalidArgumentException("All chats must be instances of " . Chat::class);
			}
		}

		foreach ($this->countryCodes as $code) {
			if (!is_string($code)) {
				throw new \InvalidArgumentException("All country codes must be strings");
			}
		}
	}

	public static function fromArray(array $array): Giveaway
	{
		return new static(
			$array["chats"] ? array_map(fn($chat) => Chat::fromArray($chat), $array["chats"]) : [],
			$array["winners_selection_date"] ?? 0,
			$array["winner_count"] ?? 0,
			$array["only_new_members"] ?? false,
			$array["has_public_winners"] ?? false,
			$array["prize_description"],
			$array["country_codes"] ?? [],
			$array["prize_star_count"],
			$array["premium_subscription_month_count"],
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"chats" => $this->chats ? array_map(fn($chat) => $chat->jsonSerialize(), $this->chats) : [],
			"winners_selection_date" => $this->winnersSelectionDate,
			"winner_count" => $this->winnerCount,
			"only_new_members" => $this->onlyNewMembers,
			"has_public_winners" => $this->hasPublicWinners,
			"prize_description" => $this->prizeDescription,
			"country_codes" => $this->countryCodes,
		];

		if (isset($this->prizeStarCount)) {
			$array["prize_star_count"] = $this->prizeStarCount;
		}
		if (isset($this->premiumSubscriptionMonthCount)) {
			$array["premium_subscription_month_count"] = $this->premiumSubscriptionMonthCount;
		}

		return $array;
	}

	/**
	 * @return Chat[]
	 */
	public function getChats(): array
	{
		return $this->chats;
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
	 * @return bool
	 */
	public function isOnlyNewMembers(): bool
	{
		return $this->onlyNewMembers;
	}

	/**
	 * @return bool
	 */
	public function hasPublicWinners(): bool
	{
		return $this->hasPublicWinners;
	}

	/**
	 * @return string|null
	 */
	public function getPrizeDescription(): ?string
	{
		return $this->prizeDescription;
	}

	/**
	 * @return string[]
	 */
	public function getCountryCodes(): array
	{
		return $this->countryCodes;
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
}