<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberowner
 */
class ChatMemberOwner implements \JsonSerializable
{
	protected string $status;
	protected User $user;
	protected bool $isAnonymous;
	protected ?string $customTitle;

	public function __construct(
		string $status = "creator",
		User $user = null,
		bool $isAnonymous = false,
		?string $customTitle = null
	)
	{
		$this->status = $status;
		$this->user = $user;
		$this->isAnonymous = $isAnonymous;
		$this->customTitle = $customTitle;

		if ($this->status != "creator"){
			throw new \InvalidArgumentException("Invalid status for ChatMemberOwner. Must be 'creator', got {$this->status}");
		}
	}

	public static function fromArray(array $array): ChatMemberOwner
	{
		return new static(
			$array["status"] ?? "",
			User::fromArray($array["user"]),
			$array["is_anonymous"] ?? false,
			$array["custom_title"],
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"status" => $this->status,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
			"is_anonymous" => $this->isAnonymous,
		];

		if (isset($this->customTitle)){
			$array["custom_title"] = $this->customTitle;
		}

		return $array;
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
	 * @return bool
	 */
	public function isAnonymous(): bool
	{
		return $this->isAnonymous;
	}

	/**
	 * @return string|null
	 */
	public function getCustomTitle(): ?string
	{
		return $this->customTitle;
	}
}