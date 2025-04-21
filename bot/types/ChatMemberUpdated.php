<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberupdated
 */
class ChatMemberUpdated implements \JsonSerializable
{
	protected Chat $chat;
	protected User $from;
	protected int $date;
	protected ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned $oldChatMember;
	protected ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned $newChatMember;
	protected ?ChatInviteLink $inviteLink;
	protected bool $viaJoinRequest;
	protected bool $viaChatFolderInviteLink;

	public function __construct(
		Chat $chat = null,
		User $from = null,
		int $date = 0,
		ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned $oldChatMember = null,
		ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned $newChatMember = null,
		?ChatInviteLink $inviteLink = null,
		bool $viaJoinRequest = false,
		bool $viaChatFolderInviteLink = false
	)
	{
		$this->chat = $chat;
		$this->from = $from;
		$this->date = $date;
		$this->oldChatMember = $oldChatMember;
		$this->newChatMember = $newChatMember;
		$this->inviteLink = $inviteLink;
		$this->viaJoinRequest = $viaJoinRequest;
		$this->viaChatFolderInviteLink = $viaChatFolderInviteLink;
	}

	public static function fromArray(array $array): ChatMemberUpdated
	{
		return new static(
			Chat::fromArray($array["chat"]),
			User::fromArray($array["from"]),
			$array["date"] ?? 0,
			ChatMember::fromArray($array["old_chat_member"]),
			ChatMember::fromArray($array["new_chat_member"]),
			$array["invite_link"] ? ChatInviteLink::fromArray($array["invite_link"]) : null,
			$array["via_join_request"] ?? false,
			$array["via_chat_folder_invite_link"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"chat" => $this->chat->jsonSerialize(),
			"from" => $this->from->jsonSerialize(),
			"date" => $this->date,
			"old_chat_member" => $this->oldChatMember->jsonSerialize(),
			"new_chat_member" => $this->newChatMember->jsonSerialize(),
			"via_join_request" => $this->viaJoinRequest,
			"via_chat_folder_invite_link" => $this->viaChatFolderInviteLink,
		];

		if ($this->inviteLink){
			$array["invite_link"] = $this->inviteLink->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return User
	 */
	public function getFrom(): User
	{
		return $this->from;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	 */
	public function getOldChatMember(): ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	{
		return $this->oldChatMember;
	}

	/**
	 * @return ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	 */
	public function getNewChatMember(): ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	{
		return $this->newChatMember;
	}

	/**
	 * @return ChatInviteLink|null
	 */
	public function getInviteLink(): ?ChatInviteLink
	{
		return $this->inviteLink;
	}

	/**
	 * @return bool
	 */
	public function isViaJoinRequest(): bool
	{
		return $this->viaJoinRequest;
	}

	/**
	 * @return bool
	 */
	public function isViaChatFolderInviteLink(): bool
	{
		return $this->viaChatFolderInviteLink;
	}
}