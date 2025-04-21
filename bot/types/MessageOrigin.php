<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageorigin
 */
class MessageOrigin
{
	public static function fromArray(array $array): MessageOriginUser|MessageOriginHiddenUser|MessageOriginChat|MessageOriginChannel
	{
		switch ($array["type"]) {
			case "user":
				return MessageOriginUser::fromArray($array);
			case "hidden_user":
				return MessageOriginHiddenUser::fromArray($array);
			case "chat":
				return MessageOriginChat::fromArray($array);
			case "channel":
				return MessageOriginChannel::fromArray($array);
			default:
				throw new \InvalidArgumentException("Unknown message origin type: " . $array["type"]);
		}
	}
}