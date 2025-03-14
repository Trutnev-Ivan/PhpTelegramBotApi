<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businessconnection
 */
class BusinessConnection implements \JsonSerializable
{
	protected string $id;
	protected User $user;
	protected int $userChatId;
	protected int $date;
	protected bool $canReply;
	protected bool $isEnabled;

	public function __construct(
		string $id = "",
		User $user = null,
		int $userChatId = 0,
		int $date = 0,
		bool $canReply = false,
		bool $isEnabled = false
	)
	{
		$this->id = $id;
		$this->user = $user;
		$this->userChatId = $userChatId;
		$this->date = $date;
		$this->canReply = $canReply;
		$this->isEnabled = $isEnabled;
	}

	public static function fromArray(array $array): BusinessConnection
	{
		return new static(
			$array["id"] ?? "",
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["user_chat_id"] ?? 0,
			$array["date"] ?? 0,
			$array["can_reply"] ?? false,
			$array["is_enabled"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"id" => $this->id,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
			"user_chat_id" => $this->userChatId,
			"date" => $this->date,
			"can_reply" => $this->canReply,
			"is_enabled" => $this->isEnabled,
		];
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
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
	public function getUserChatId(): int
	{
		return $this->userChatId;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return bool
	 */
	public function canReply(): bool
	{
		return $this->canReply;
	}

	/**
	 * @return bool
	 */
	public function isEnabled(): bool
	{
		return $this->isEnabled;
	}
}