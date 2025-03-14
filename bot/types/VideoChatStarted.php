<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#videochatstarted
 */
class VideoChatStarted implements \JsonSerializable
{
	public static function fromArray(array $array): VideoChatStarted
	{
		return new static();
	}

	public function jsonSerialize(): array
	{
		return [];
	}
}