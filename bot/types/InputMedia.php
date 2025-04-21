<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputmedia
 */
class InputMedia
{
	public static function fromArray(array $array): InputMediaAnimation|InputMediaDocument|InputMediaAudio|InputMediaPhoto|InputMediaVideo
	{
		switch ($array["type"]) {
			case "animation":
				return InputMediaAnimation::fromArray($array);
			case "document":
				return InputMediaDocument::fromArray($array);
			case "audio":
				return InputMediaAudio::fromArray($array);
			case "photo":
				return InputMediaPhoto::fromArray($array);
			case "video":
				return InputMediaVideo::fromArray($array);
			default:
				throw new \InvalidArgumentException("Unsupported media type: " . $array["type"]);
		}
	}
}