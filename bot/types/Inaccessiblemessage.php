<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inaccessiblemessage
 */
class InaccessibleMessage implements \JsonSerializable
{
	protected Chat $chat;
	protected int $messageId;
	protected int $date;

	public function __construct(
		Chat $chat = null,
		int $messageId = 0,
		int $date = 0
	)
	{
		$this->chat = $chat;
		$this->messageId = $messageId;
		$this->date = $date;
	}

	public static function fromArray(array $array): InaccessibleMessage
	{
		return new static(
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["message_id"] ?? 0,
			$array["date"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat->jsonSerialize(),
			"message_id" => $this->messageId,
			"date" => $this->date
		];
	}
}