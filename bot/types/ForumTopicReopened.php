<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forumtopicreopened
 */
class ForumTopicReopened implements \JsonSerializable
{
	public static function fromArray(array $array): ForumTopicReopened
	{
		return new static();
	}

	public function jsonSerialize(): array
	{
		return [];
	}
}