<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopechat
 */
class BotCommandScopeChat implements \JsonSerializable
{
	protected string $type;
	protected string|int $chatId;

	public function __construct(
		string $type = "",
		string|int $chatId = 0
	)
	{
		$this->type = $type;
		$this->chatId = $chatId;
	}

	public static function fromArray(array $array): BotCommandScopeChat
	{
		return new static(
			$array["type"] ?? "",
			$array["chat_id"] ?? 0
		);
	}

	public function jsonSerialize()
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