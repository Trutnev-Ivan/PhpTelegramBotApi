<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botname
 */
class BotName implements \JsonSerializable
{
	protected string $name;

	public function __construct(
		string $name = ""
	)
	{
		$this->name = $name;
	}

	public static function fromArray(array $array): BotName
	{
		return new static($array["name"]);
	}

	public function jsonSerialize()
	{
		return [
			"name" => $this->name,
		];
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}