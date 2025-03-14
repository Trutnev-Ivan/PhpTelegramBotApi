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
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["boost"] ? ChatBoost::fromArray($array["boost"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"boost" => $this->boost ? $this->boost->jsonSerialize() : null,
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