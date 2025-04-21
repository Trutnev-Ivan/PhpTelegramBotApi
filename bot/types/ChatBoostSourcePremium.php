<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsourcepremium
 */
class ChatBoostSourcePremium implements \JsonSerializable
{
	protected string $source;
	protected User $user;

	public function __construct(
		string $source = "premium",
		User $user = null
	)
	{
		$this->source = $source;
		$this->user = $user;

		if ($this->source != "premium"){
			throw new \Exception("Invalid source type. Expected 'premium', got '{$source}'");
		}
	}

	public static function fromArray(array $array): ChatBoostSourcePremium
	{
		return new static(
			$array["source"] ?? "premium",
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