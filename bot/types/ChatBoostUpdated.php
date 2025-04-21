<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostupdated
 */
class ChatBoostUpdated implements \JsonSerializable
{
	protected Chat $chat;
	protected ChatBoost $boost;

	public function __construct(
		Chat $chat = null,
		ChatBoost $boost = null
	)
	{
		$this->chat = $chat;
		$this->boost = $boost;
	}

	public static function fromArray(array $array): ChatBoostUpdated
	{
		return new static(
			Chat::fromArray($array["chat"]),
			ChatBoost::fromArray($array["boost"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"chat" => $this->chat->jsonSerialize(),
			"boost" => $this->boost->jsonSerialize(),
		];
	}

	/**
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return ChatBoost
	 */
	public function getBoost(): ChatBoost
	{
		return $this->boost;
	}
}