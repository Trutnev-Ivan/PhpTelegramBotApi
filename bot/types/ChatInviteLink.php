<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatinvitelink
 */
class ChatInviteLink implements \JsonSerializable
{
	protected string $inviteLink;
	protected User $creator;
	protected bool $createsJoinRequest;
	protected bool $isPrimary;
	protected bool $isRevoked;
	protected ?string $name;
	protected ?int $expireDate;
	protected ?int $memberLimit;
	protected ?int $pendingJoinRequestCount;
	protected ?int $subscriptionPeriod;
	protected ?int $subscriptionPrice;

	public function __construct(
		string $inviteLink = "",
		User $creator = null,
		bool $createsJoinRequestd = false,
		bool $isPrimaryd = false,
		bool $isRevoked = false,
		?string $name = null,
		?int $expireDate = null,
		?int $memberLimit = null,
		?int $pendingJoinRequestCount = null,
		?int $subscriptionPeriod = null,
		?int $subscriptionPrice = null
	)
	{
		$this->inviteLink = $inviteLink;
		$this->creator = $creator;
		$this->createsJoinRequest = $createsJoinRequestd;
		$this->isPrimary = $isPrimaryd;
		$this->isRevoked = $isRevoked;
		$this->name = $name;
		$this->expireDate = $expireDate;
		$this->memberLimit = $memberLimit;
		$this->pendingJoinRequestCount = $pendingJoinRequestCount;
		$this->subscriptionPeriod = $subscriptionPeriod;
		$this->subscriptionPrice = $subscriptionPrice;
	}

	public static function fromArray(array $array): ChatInviteLink
	{
		return new static(
			$array["invite_link"] ?? "",
			User::fromArray($array["creator"]),
			$array["creates_join_request"] ?? false,
			$array["is_primary"] ?? false,
			$array["is_revoked"] ?? false,
			$array["name"],
			$array["expire_date"],
			$array["member_limit"],
			$array["pending_join_request_count"],
			$array["subscription_period"],
			$array["subscription_price"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"invite_link" => $this->inviteLink,
			"creator" => $this->creator->jsonSerialize(),
			"creates_join_request" => $this->createsJoinRequest,
			"is_primary" => $this->isPrimary,
			"is_revoked" => $this->isRevoked,
		];

		if (isset($this->name)) {
			$array["name"] = $this->name;
		}
		if (isset($this->expireDate)) {
			$array["expire_date"] = $this->expireDate;
		}
		if (isset($this->memberLimit)) {
			$array["member_limit"] = $this->memberLimit;
		}
		if (isset($this->pendingJoinRequestCount)) {
			$array["pending_join_request_count"] = $this->pendingJoinRequestCount;
		}
		if (isset($this->subscriptionPeriod)) {
			$array["subscription_period"] = $this->subscriptionPeriod;
		}
		if (isset($this->subscriptionPrice)) {
			$array["subscription_price"] = $this->subscriptionPrice;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getInviteLink(): string
	{
		return $this->inviteLink;
	}

	/**
	 * @return User
	 */
	public function getCreator(): User
	{
		return $this->creator;
	}

	/**
	 * @return bool
	 */
	public function isCreatesJoinRequest(): bool
	{
		return $this->createsJoinRequest;
	}

	/**
	 * @return bool
	 */
	public function isPrimary(): bool
	{
		return $this->isPrimary;
	}

	/**
	 * @return bool
	 */
	public function isRevoked(): bool
	{
		return $this->isRevoked;
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @return int|null
	 */
	public function getExpireDate(): ?int
	{
		return $this->expireDate;
	}

	/**
	 * @return int|null
	 */
	public function getMemberLimit(): ?int
	{
		return $this->memberLimit;
	}

	/**
	 * @return int|null
	 */
	public function getPendingJoinRequestCount(): ?int
	{
		return $this->pendingJoinRequestCount;
	}

	/**
	 * @return int|null
	 */
	public function getSubscriptionPeriod(): ?int
	{
		return $this->subscriptionPeriod;
	}

	/**
	 * @return int|null
	 */
	public function getSubscriptionPrice(): ?int
	{
		return $this->subscriptionPrice;
	}
}