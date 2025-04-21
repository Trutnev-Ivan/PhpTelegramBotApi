<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#maybeinaccessiblemessage
 */
class MaybeInaccessibleMessage
{
	public static function fromArray(array $array):
	Message
	|InaccessibleMessage
	{
		if (isset($array["date"]) && $array["date"] == 0){
			return InaccessibleMessage::fromArray($array);
		}

		return Message::fromArray($array);
	}
}