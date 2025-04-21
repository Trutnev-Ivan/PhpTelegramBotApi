<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsourcegiftcode
 */
class ChatBoostSourceGiftCode implements \JsonSerializable
{
	protected string $source;
	protected User $user;

	public function __construct(
		string $source = "gift_code",
		User $user = null
	)
	{
		$this->source = $source;
		$this->user = $user;

		if ($this->source != "gift_code"){
			throw new \InvalidArgumentException("Source must be 'gift_code', got '$source'");
		}
	}

	public static function fromArray(array $array): ChatBoostSourceGiftCode
	{
		return new static(
			$array["source"] ?? "gift_code",
			User::fromArray($array["user"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"source" => $this->source,
			"user" => $this->user->jsonSerialize(),
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