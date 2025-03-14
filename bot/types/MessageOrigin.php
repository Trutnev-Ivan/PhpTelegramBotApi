<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageorigin
 */
class MessageOrigin implements \JsonSerializable
{
	//TODO: заполнить после создания остальных классов

	public static function fromArray(array $array): MessageOrigin
	{
		return new static();
	}

	public function jsonSerialize()
	{
		return [

		];
	}
}