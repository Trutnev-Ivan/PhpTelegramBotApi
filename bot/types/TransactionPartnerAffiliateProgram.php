<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartneraffiliateprogram
 */
class TransactionPartnerAffiliateProgram implements \JsonSerializable
{
	protected string $type;
	protected ?User $sponsorUser;
	protected int $commissionPerMille;

	public function __construct(
		string $type = "affiliate_program",
		?User $sponsorUser = null,
		int $commissionPerMille = 0
	)
	{
		$this->type = $type;
		$this->sponsorUser = $sponsorUser;
		$this->commissionPerMille = $commissionPerMille;

		if ($this->type != "affiliate_program") {
			throw new \InvalidArgumentException("Invalid type provided for TransactionPartnerAffiliateProgram. Must be 'affiliate_program', got '{$this->type}'");
		}
	}

	public static function fromArray(array $array): TransactionPartnerAffiliateProgram
	{
		return new static(
			$array["type"] ?? "affiliate_program",
			isset($array["sponsor_user"]) ? User::fromArray($array["sponsor_user"]) : null,
			$array["commission_per_mille"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"commission_per_mille" => $this->commissionPerMille,
		];

		if (isset($this->sponsorUser)) {
			$array["sponsor_user"] = $this->sponsorUser->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return User|null
	 */
	public function getSponsorUser(): ?User
	{
		return $this->sponsorUser;
	}

	/**
	 * @return int
	 */
	public function getCommissionPerMille(): int
	{
		return $this->commissionPerMille;
	}
}