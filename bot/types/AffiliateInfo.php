<?php namespace Telegram\Bot\Types;

/**
 * https://core.telegram.org/bots/api#affiliateinfo
 */
class AffiliateInfo implements \JsonSerializable
{
	protected ?User $affiliateUser;
	protected ?Chat $affiliateChat;
	protected int $commissionPerMille;
	protected int $amount;
	protected ?int $nanostarAmount;

	public function __construct(
		?User $affiliateUser = null,
		?Chat $affiliateChat = null,
		int $commissionPerMille = 0,
		int $amount = 0,
		?int $nanostarAmount = null
	)
	{
		$this->affiliateUser = $affiliateUser;
		$this->affiliateChat = $affiliateChat;
		$this->commissionPerMille = $commissionPerMille;
		$this->amount = $amount;
		$this->nanostarAmount = $nanostarAmount;
	}

	public static function fromArray(array $array): AffiliateInfo
	{
		return new static(
			isset($array["affiliate_user"]) ? User::fromArray($array["affiliate_user"]) : null,
			isset($array["affiliate_chat"]) ? Chat::fromArray($array["affiliate_chat"]) : null,
			$array["commission_per_mille"] ?? 0,
			$array["amount"] ?? 0,
			$array["nanostar_amount"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"commission_per_mille" => $this->commissionPerMille,
			"amount" => $this->amount,
		];

		if (isset($this->affiliateUser)) {
			$array["affiliate_user"] = $this->affiliateUser->jsonSerialize();
		}
		if (isset($this->affiliateChat)) {
			$array["affiliate_chat"] = $this->affiliateChat->jsonSerialize();
		}
		if (isset($this->nanostarAmount)) {
			$array["nanostar_amount"] = $this->nanostarAmount;
		}

		return $array;
	}

	/**
	 * @return User|null
	 */
	public function getAffiliateUser(): ?User
	{
		return $this->affiliateUser;
	}

	/**
	 * @return Chat|null
	 */
	public function getAffiliateChat(): ?Chat
	{
		return $this->affiliateChat;
	}

	/**
	 * @return int
	 */
	public function getCommissionPerMille(): int
	{
		return $this->commissionPerMille;
	}

	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @return int|null
	 */
	public function getNanostarAmount(): ?int
	{
		return $this->nanostarAmount;
	}
}