<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontype
 */
class ReactionType implements \JsonSerializable
{

	//TODO: добавить потом

	public static function fromArray(array $array): ReactionType
	{

	}

	public function jsonSerialize()
	{
		return [];
	}
}