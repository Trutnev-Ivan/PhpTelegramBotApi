<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberleft
 */
class ChatMemberLeft implements \JsonSerializable
{
	protected string $status;
	protected User $user;

	public function __construct(
		string $status = "left",
		User $user = null
	)
	{
		$this->status = $status;
		$this->user = $user;

		if ($this->status != "left"){
			throw new \InvalidArgumentException("Invalid status. Must be 'left', got {$this->status}");
		}
	}

	public static function fromArray(array $array): ChatMemberLeft
	{
		return new static(
			$array["status"] ?? "left",
			User::fromArray($array["user"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"status" => $this->status,
			"user" => $this->user->jsonSerialize(),
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
}