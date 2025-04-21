<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#menubuttoncommands
 */
class MenuButtonCommands implements \JsonSerializable
{
	protected string $type = "commands";

	public function __construct(
		string $type = "commands"
	)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): MenuButtonCommands
	{
		return new static($array["type"] ?? "");
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}