<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscopechatmember
 */
class BotCommandScopeChatMember implements \JsonSerializable
{
	protected string $type;
	protected string|int $chatId;
	protected int $userId;

	public function __construct(
		string $type = "chat_member",
		string|int $chatId = 0,
		int $userId = 0
	)
	{
		$this->type = $type;
		$this->chatId = $chatId;
		$this->userId = $userId;

		if ($this->type != "chat_member"){
			throw new \InvalidArgumentException("Invalid type provided for BotCommandScopeChatMember. Must be 'chat_member', got {$this->type}");
		}
	}

	public static function fromArray(array $array): BotCommandScopeChatMember
	{
		return new static(
			$array["type"] ?? "",
			$array["chat_id"] ?? 0,
			$array["user_id"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"chat_id" => $this->chatId,
			"user_id" => $this->userId,
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
	
	/**
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->userId;
	}
}