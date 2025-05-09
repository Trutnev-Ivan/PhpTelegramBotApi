<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageoriginuser
 */
class MessageOriginUser implements \JsonSerializable
{
	protected string $type;
	protected int $date;
	protected User $senderUser;

	public function __construct(
		string $type = "user",
		int $date = 0,
		User $senderUser = null
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->senderUser = $senderUser;

		if ($this->type != "user"){
			throw new \InvalidArgumentException("Invalid type for MessageOriginUser. Must be 'user', got {$this->type}");
		}
	}

	public static function fromArray(array $array): MessageOriginUser
	{
		return new static(
			$array["type"] ?? "user",
			$array["date"] ?? 0,
			$array["sender_user"] ? User::fromArray($array["sender_user"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"date" => $this->date,
			"sender_user" => $this->senderUser->jsonSerialize()
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return User
	 */
	public function getSenderUser(): User
	{
		return $this->senderUser;
	}
}