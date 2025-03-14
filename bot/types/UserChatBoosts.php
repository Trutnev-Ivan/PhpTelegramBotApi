<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#userchatboosts
 */
class UserChatBoosts implements \JsonSerializable
{
	/**
	 * @var ChatBoost[]
	 */
	protected array $boosts;

	public function __construct(
		array $boosts = []
	)
	{
		$this->boosts = $boosts;

		foreach ($this->boosts as $boost) {
			if (!$boost instanceof ChatBoost) {
				throw new \InvalidArgumentException("All elements in 'boosts' must be instances of " . ChatBoost::class);
			}
		}
	}

	public static function fromArray(array $array): UserChatBoosts
	{
		return new static(
			$array["boosts"] ? array_map(fn($boost) => ChatBoost::fromArray($boost), $array["boosts"]) : []
		);
	}

	public function jsonSerialize()
	{
		return [
			"boosts" => $this->boosts ? array_map(fn($boost) => $boost->jsonSerialize(), $this->boosts) : [],
		];
	}

	/**
	 * @return ChatBoost[]
	 */
	public function getBoosts(): array
	{
		return $this->boosts;
	}
}