<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmembermember
 */
class ChatMemberMember implements \JsonSerializable
{
	protected string $status;
	protected User $user;
	protected int $untilDate;

	public function __construct(
		string $status = "member",
		User $user = null,
		int $untilDate = 0
	)
	{
		$this->status = $status;
		$this->user = $user;
		$this->untilDate = $untilDate;

		if ($this->status != "member"){
			throw new \InvalidArgumentException("Invalid status provided for ChatMemberMember. Must be 'member', got {$this->status}'");
		}
	}

	public static function fromArray(array $array): ChatMemberMember
	{
		return new static(
			$array["status"] ?? "member",
			User::fromArray($array["user"]),
			$array["until_date"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"status" => $this->status,
			"user" => $this->user->jsonSerialize(),
			"until_date" => $this->untilDate,
		];
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return int
	 */
	public function getUntilDate(): int
	{
		return $this->untilDate;
	}
}