<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberupdated
 */
class ChatMemberUpdated implements \JsonSerializable
{
	protected Chat $chat;
	protected User $from;
	protected int $date;
	protected ChatMember $oldChatMember;
	protected ChatMember $newChatMember;
	protected ?ChatInviteLink $inviteLink;
	protected bool $viaJoinRequest;
	protected bool $viaChatFolderInviteLink;

	public function __construct(
		Chat $chat = null,
		User $from = null,
		int $date = 0,
		ChatMember $oldChatMember = null,
		ChatMember $newChatMember = null,
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
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["date"] ?? 0,
			$array["old_chat_member"] ? ChatMember::fromArray($array["old_chat_member"]) : null,
			$array["new_chat_member"] ? ChatMember::fromArray($array["new_chat_member"]) : null,
			$array["invite_link"] ? ChatInviteLink::fromArray($array["invite_link"]) : null,
			$array["via_join_request"] ?? false,
			$array["via_chat_folder_invite_link"] ?? false
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"date" => $this->date,
			"old_chat_member" => $this->oldChatMember ? $this->oldChatMember->jsonSerialize() : null,
			"new_chat_member" => $this->newChatMember ? $this->newChatMember->jsonSerialize() : null,
			"invite_link" => $this->inviteLink ? $this->inviteLink->jsonSerialize() : null,
			"via_join_request" => $this->viaJoinRequest,
			"via_chat_folder_invite_link" => $this->viaChatFolderInviteLink,
		];
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
	 * @return ChatMember
	 */
	public function getOldChatMember(): ChatMember
	{
		return $this->oldChatMember;
	}

	/**
	 * @return ChatMember
	 */
	public function getNewChatMember(): ChatMember
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