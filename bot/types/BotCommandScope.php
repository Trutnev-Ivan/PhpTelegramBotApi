<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscope
 */
class BotCommandScope implements \JsonSerializable
{
	//TODO: заполнить после

	public static function fromArray(array $array): BotCommandScope
	{

	}

	public function jsonSerialize()
	{
		return [];
	}
}