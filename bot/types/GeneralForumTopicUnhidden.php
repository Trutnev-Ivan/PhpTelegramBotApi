<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#generalforumtopicunhidden
 */
class GeneralForumTopicUnhidden implements \JsonSerializable
{
	public static function fromArray(array $array): GeneralForumTopicUnhidden
	{
		return new static();
	}

	public function jsonSerialize(): array
	{
		return [];
	}
}