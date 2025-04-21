<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmedia
 */
class PaidMedia
{
	public static function fromArray(array $array): PaidMediaPhoto|PaidMediaVideo|PaidMediaPreview
	{
		switch ($array["type"]) {
			case "photo":
				return PaidMediaPhoto::fromArray($array);
			case "video":
				return PaidMediaVideo::fromArray($array);
			case "preview":
				return PaidMediaPreview::fromArray($array);
			default:
				throw new \InvalidArgumentException("Invalid PaidMedia type: " . $array["type"]);
		}
	}
}