<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageid
 */
class MessageId implements \JsonSerializable
{
	protected int $messageId;

	public function __construct(int $messageId = 0)
	{
		$this->messageId = $messageId;
	}

	public static function fromArray(array $array): MessageId
	{
		return new static($array["message_id"] ?? 0);
	}

	public function getMessageId(): int
	{
		return $this->messageId;
	}

	public function jsonSerialize(): array
	{
		return [
			"message_id" => $this->messageId,
		];
	}
}