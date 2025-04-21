<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommandscope
 */
class BotCommandScope
{
	public static function fromArray(array $array):
		BotCommandScopeDefault
		| BotCommandScopeAllPrivateChats
		| BotCommandScopeAllGroupChats
		| BotCommandScopeAllChatAdministrators
		| BotCommandScopeChat
		| BotCommandScopeChatAdministrators
		| BotCommandScopeChatMember
	{
		switch ($array["type"]){
			case "default":
				return BotCommandScopeDefault::fromArray($array);
			case "all_private_chats":
				return BotCommandScopeAllPrivateChats::fromArray($array);
			case "all_group_chats":
				return BotCommandScopeAllGroupChats::fromArray($array);
			case "all_chat_administrators":
				return BotCommandScopeAllChatAdministrators::fromArray($array);
			case "chat":
				return BotCommandScopeChat::fromArray($array);
			case "chat_administrators":
				return BotCommandScopeChatAdministrators::fromArray($array);
			case "chat_member":
				return BotCommandScopeChatMember::fromArray($array);
			default:
				throw new \InvalidArgumentException("Unknown BotCommandScope type: {$array["type"]}");
		}
	}
}