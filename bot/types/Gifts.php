<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#gifts
 */
class Gifts implements \JsonSerializable
{
	/**
	 * @var Gift[]
	 */
	protected array $gifts;

	public function __construct(
		array $gifts = []
	)
	{
		$this->gifts = $gifts;

		foreach ($this->gifts as $gift) {
			if (!$gift instanceof Gift) {
				throw new \InvalidArgumentException("All elements in 'gifts' must be instances of Gift");
			}
		}
	}

	public static function fromArray(array $array): Gifts
	{
		return new static(
			array_map(fn($item) => Gift::fromArray($item), $array["gifts"] ?? [])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"gifts" => $this->gifts ? array_map(fn($gift) => $gift->jsonSerialize(), $this->gifts) : [],
		];
	}

	/**
	 * @return Gift[]
	 */
	public function getGifts(): array
	{
		return $this->gifts;
	}
}