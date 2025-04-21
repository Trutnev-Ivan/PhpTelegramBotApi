<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopeallchatadministrators
 */
class BotCommandScopeAllChatAdministrators implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "all_chat_administrators"
	)
	{
		$this->type = $type;

		if ($this->type != "all_chat_administrators"){
			throw new \InvalidArgumentException("Invalid BotCommandScopeAllChatAdministrators type. Must be 'all_chat_administrators'");
		}
	}

	public static function fromArray(array $array): BotCommandScopeAllChatAdministrators
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