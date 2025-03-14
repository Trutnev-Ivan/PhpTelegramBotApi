<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forumtopicclosed
 */
class ForumTopicClosed implements \JsonSerializable
{
	public static function fromArray(array $array): ForumTopicClosed
	{
		return new static();
	}

	public function jsonSerialize(): array
	{
		return [];
	}
}