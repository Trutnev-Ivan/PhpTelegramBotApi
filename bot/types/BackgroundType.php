<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtype
 */
class BackgroundType
{
	public static function fromArray(array $array): BackgroundTypeFill
		|BackgroundTypeWallpaper
		|BackgroundTypePattern
		|BackgroundTypeChatTheme
	{
		switch ($array["type"]){
			case "fill":
                return BackgroundTypeFill::fromArray($array);
            case "wallpaper":
                return BackgroundTypeWallpaper::fromArray($array);
            case "pattern":
                return BackgroundTypePattern::fromArray($array);
            case "chat_theme":
                return BackgroundTypeChatTheme::fromArray($array);
            default:
                throw new \InvalidArgumentException("Unknown background type: " . $array["type"]);
		}
	}
}
