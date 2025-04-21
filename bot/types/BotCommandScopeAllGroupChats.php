<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopeallgroupchats
 */
class BotCommandScopeAllGroupChats implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "all_group_chats"
	)
	{
		$this->type = $type;
		
		if ($this->type != "all_group_chats"){
			throw new \InvalidArgumentException("Invalid type for BotCommandScopeAllGroupChats. Expected 'all_group_chats', got '{$this->type}'.");
		}
	}

	public static function fromArray(array $array): BotCommandScopeAllGroupChats
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