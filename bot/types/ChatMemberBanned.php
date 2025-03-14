<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberbanned
 */
class ChatMemberBanned implements \JsonSerializable
{
	protected string $status;
	protected User $user;
	protected int $untilDate;

	public function __construct(
		string $status = "",
		User $user = null,
		int $untilDate = 0
	)
	{
		$this->status = $status;
		$this->user = $user;
		$this->untilDate = $untilDate;
	}

	public static function fromArray(array $array): ChatMemberBanned
	{
		return new static(
			$array["status"] ?? "",
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["until_date"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"status" => $this->status,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
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