<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopeallprivatechats
 */
class BotCommandScopeAllPrivateChats implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type="all_private_chats"
	)
	{
		$this->type = $type;

		if ($this->type!== "all_private_chats") {
            throw new \InvalidArgumentException("Invalid BotCommandScopeAllPrivateChats type. Must be 'all_private_chats', got {$this->type}");
        }
	}

	public static function fromArray(array $array): BotCommandScopeAllPrivateChats
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