<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsource
 */
class ChatBoostSource implements \JsonSerializable
{
	//TODO: заполнить после создания остальных классов

	public static function fromArray(array $array): ChatBoostSource
	{

	}

	public function jsonSerialize()
	{
		return [];
	}
}