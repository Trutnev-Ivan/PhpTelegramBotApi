<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#dice
 */
class Dice implements \JsonSerializable
{
	protected string $emoji;
	protected int $value;

	public function __construct(
		string $emoji = "",
		int $value = 0
	)
	{
		$this->emoji = $emoji;
		$this->value = $value;
	}

	public static function fromArray(array $array): Dice
	{
		return new static(
			$array["emoji"] ?? "",
			$array["value"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"emoji" => $this->emoji,
			"value" => $this->value,
		];
	}

	/**
	 * @return string
	 */
	public function getEmoji(): string
	{
		return $this->emoji;
	}

	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}
}