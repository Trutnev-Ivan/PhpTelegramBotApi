<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberleft
 */
class ChatMemberLeft implements \JsonSerializable
{
	protected string $status;
	protected User $user;

	public function __construct(
		string $status,
		User $user
	)
	{
		$this->status = $status;
		$this->user = $user;
	}

	public static function fromArray(array $array): ChatMemberLeft
	{
		return new static(
			$array["status"] ?? "",
			$array["user"] ? User::fromArray($array["user"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"status" => $this->status,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
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