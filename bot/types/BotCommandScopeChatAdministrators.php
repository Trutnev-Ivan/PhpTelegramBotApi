<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopechatadministrators
 */
class BotCommandScopeChatAdministrators implements \JsonSerializable
{
	protected string $type;
	protected string|int $chatId;

	public function __construct(
		string $type = "chat_administrators",
		string|int $chatId = 0
	)
	{
		$this->type = $type;
		$this->chatId = $chatId;

		if ($this->type != "chat_administrators"){
			throw new \InvalidArgumentException("Invalid type for BotCommandScopeChatAdministrators. Must be 'chat_administrators', got {$this->type}");
		}
	}

	public static function fromArray(array $array): BotCommandScopeChatAdministrators
	{
		return new static(
			$array["type"] ?? "",
			$array["chat_id"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"chat_id" => $this->chatId,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return int|string
	 */
	public function getChatId(): int|string
	{
		return $this->chatId;
	}
}