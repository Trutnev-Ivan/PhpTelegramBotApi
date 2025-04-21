<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostsource
 */
class ChatBoostSource
{
	public static function fromArray(array $array):
	ChatBoostSourcePremium
	| ChatBoostSourceGiftCode
	| ChatBoostSourceGiveaway
	{
		switch ($array["source"]){
			case "premium":
				return ChatBoostSourcePremium::fromArray($array);
			case "gift_code":
				return ChatBoostSourceGiftCode::fromArray($array);
			case "giveaway":
				return ChatBoostSourceGiveaway::fromArray($array);
		}

		throw new \InvalidArgumentException("Unknown source type: '{$array["source"]}'");
	}
}