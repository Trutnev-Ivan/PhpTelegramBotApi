<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#callbackgame
 */
class CallbackGame implements \JsonSerializable
{
	public function jsonSerialize(): array
	{
		return [];
	}
}