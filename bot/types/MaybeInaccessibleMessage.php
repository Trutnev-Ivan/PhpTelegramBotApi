<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#maybeinaccessiblemessage
 */
class MaybeInaccessibleMessage implements \JsonSerializable
{

	//TODO: заполнить после создания остальных классов

	public static function fromArray(array $array): MaybeInaccessibleMessage
	{

	}

	public function jsonSerialize()
	{
		return [];
	}
}