<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopeallgroupchats
 */
class BotCommandScopeAllGroupChats implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type
	)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): BotCommandScopeAllGroupChats
	{
		return new static($array["type"] ?? "");
	}

	public function jsonSerialize()
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