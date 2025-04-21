<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontype
 */
class ReactionType
{
	public static function fromArray(array $array): ReactionTypeEmoji|ReactionTypeCustomEmoji|ReactionTypePaid
	{
		switch ($array["type"]) {
			case "emoji":
				return ReactionTypeEmoji::fromArray($array);
			case "custom_emoji":
				return ReactionTypeCustomEmoji::fromArray($array);
			case "paid":
				return ReactionTypePaid::fromArray($array);
		}

		throw new \InvalidArgumentException("Invalid reaction type: " . $array["type"]);
	}
}