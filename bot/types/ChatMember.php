<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmember
 */
class ChatMember
{
	public static function fromArray(array $array): ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	{
		if (isset($array['status'])) {
			switch ($array['status']) {
				case "creator":
					return ChatMemberOwner::fromArray($array);
				case "administrator":
					return ChatMemberAdministrator::fromArray($array);
				case "member":
					return ChatMemberMember::fromArray($array);
				case "restricted":
					return ChatMemberRestricted::fromArray($array);
				case "left":
					return ChatMemberLeft::fromArray($array);
				case "kicked":
					return ChatMemberBanned::fromArray($array);
			}
		}

		throw new \InvalidArgumentException('Invalid chat member status');
	}
}