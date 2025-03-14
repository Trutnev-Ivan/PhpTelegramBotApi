<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageautodeletetimerchanged
 */
class MessageAutoDeleteTimerChanged implements \JsonSerializable
{
	protected int $messageAutoDeleteTime;

	public function __construct(int $messageAutoDeleteTime)
	{
		$this->messageAutoDeleteTime = $messageAutoDeleteTime;
	}

	public static function fromArray(array $array): MessageAutoDeleteTimerChanged
	{
		return new static($array["message_auto_delete_time"]);
	}

	public function jsonSerialize()
	{
		return [
			"message_auto_delete_time" => $this->messageAutoDeleteTime,
		];
	}

	/**
	 * @return int
	 */
	public function getMessageAutoDeleteTime(): int
	{
		return $this->messageAutoDeleteTime;
	}
}