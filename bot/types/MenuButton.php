<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#menubutton
 */
class MenuButton
{
	public static function fromArray(array $array): MenuButtonCommands|MenuButtonWebApp|MenuButtonDefault
	{
		switch ($array["type"]) {
			case "commands":
				return MenuButtonCommands::fromArray($array);
			case "web_app":
				return MenuButtonWebApp::fromArray($array);
			case "default":
				return MenuButtonDefault::fromArray($array);
			default:
				throw new \InvalidArgumentException("Invalid MenuButton type: " . $array["type"]);
		}
	}
}