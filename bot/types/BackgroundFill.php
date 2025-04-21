<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundfill
 */
class BackgroundFill
{
	public static function fromArray(array $array): BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient
	{
		switch ($array["type"]){
			case "solid":
                return BackgroundFillSolid::fromArray($array);
            case "gradient":
                return BackgroundFillGradient::fromArray($array);
            case "freeform_gradient":
                return BackgroundFillFreeformGradient::fromArray($array);
            default:
                throw new \InvalidArgumentException("Unknown background fill type: {$array["type"]}");
		}
	}

}