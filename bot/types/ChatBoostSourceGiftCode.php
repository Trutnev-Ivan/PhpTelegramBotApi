<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsourcegiftcode
 */
class ChatBoostSourceGiftCode implements \JsonSerializable
{
	protected string $source;
	protected User $user;

	public function __construct(
		string $source,
		User $user = null
	)
	{
		$this->source = $source;
		$this->user = $user;
	}

	public static function fromArray(array $array): ChatBoostSourceGiftCode
	{
		return new static(
			$array["source"] ?? "",
			$array["user"] ? User::fromArray($array["user"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"source" => $this->source,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
		];
	}

	/**
	 * @return string
	 */
	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}
}