<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#generalforumtopichidden
 */
class GeneralForumTopicHidden implements \JsonSerializable
{
	public static function fromArray(array $array): GeneralForumTopicHidden
	{
		return new static();
	}

	public function jsonSerialize(): array
	{
		return [];
	}
}