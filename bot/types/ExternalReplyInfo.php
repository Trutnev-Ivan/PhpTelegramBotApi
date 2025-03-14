<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#externalreplyinfo
 */
class ExternalReplyInfo implements \JsonSerializable
{

	//TODO: заполнить после создания остальных классов

	public static function fromArray(array $array): ExternalReplyInfo
	{
		return new static();
	}

	public function jsonSerialize()
	{
		return [];
	}
}