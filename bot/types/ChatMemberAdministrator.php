<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatmemberadministrator
 */
class ChatMemberAdministrator implements \JsonSerializable
{
	protected string $status;
	protected User $user;
	protected bool $canBeEdited;
	protected bool $isAnonymous;
	protected bool $canManageChat;
	protected bool $canDeleteMessages;
	protected bool $canManageVideoChats;
	protected bool $canRestrictMembers;
	protected bool $canPromoteMembers;
	protected bool $canChangeInfo;
	protected bool $canInviteUsers;
	protected bool $canPostStories;
	protected bool $canEditStories;
	protected bool $canDeleteStories;
	protected bool $canPostMessages;
	protected bool $canEditMessages;
	protected bool $canPinMessages;
	protected bool $canManageTopics;
	protected string $customTitle;

	public function __construct(
		string $status = "",
		User $user = null,
		bool $canBeEdited = false,
		bool $isAnonymous = false,
		bool $canManageChat = false,
		bool $canDeleteMessages = false,
		bool $canManageVideoChats = false,
		bool $canRestrictMembers = false,
		bool $canPromoteMembers = false,
		bool $canChangeInfo = false,
		bool $canInviteUsers = false,
		bool $canPostStories = false,
		bool $canEditStories = false,
		bool $canDeleteStories = false,
		bool $canPostMessages = false,
		bool $canEditMessages = false,
		bool $canPinMessages = false,
		bool $canManageTopics = false,
		string $customTitle = ""
	)
	{
		$this->status = $status;
		$this->user = $user;
		$this->canBeEdited = $canBeEdited;
		$this->isAnonymous = $isAnonymous;
		$this->canManageChat = $canManageChat;
		$this->canDeleteMessages = $canDeleteMessages;
		$this->canManageVideoChats = $canManageVideoChats;
		$this->canRestrictMembers = $canRestrictMembers;
		$this->canPromoteMembers = $canPromoteMembers;
		$this->canChangeInfo = $canChangeInfo;
		$this->canInviteUsers = $canInviteUsers;
		$this->canPostStories = $canPostStories;
		$this->canEditStories = $canEditStories;
		$this->canDeleteStories = $canDeleteStories;
		$this->canPostMessages = $canPostMessages;
		$this->canEditMessages = $canEditMessages;
		$this->canPinMessages = $canPinMessages;
		$this->canManageTopics = $canManageTopics;
		$this->customTitle = $customTitle;
	}

	public static function fromArray(array $array): ChatMemberAdministrator
	{
		return new static(
			$array["status"] ?? "",
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["can_be_edited"] ?? false,
			$array["is_anonymous"] ?? false,
			$array["can_manage_chat"] ?? false,
			$array["can_delete_messages"] ?? false,
			$array["can_manage_video_chats"] ?? false,
			$array["can_restrict_members"] ?? false,
			$array["can_promote_members"] ?? false,
			$array["can_change_info"] ?? false,
			$array["can_invite_users"] ?? false,
			$array["can_post_stories"] ?? false,
			$array["can_edit_stories"] ?? false,
			$array["can_delete_stories"] ?? false,
			$array["can_post_messages"] ?? false,
			$array["can_edit_messages"] ?? false,
			$array["can_pin_messages"] ?? false,
			$array["can_manage_topics"] ?? false,
			$array["custom_title"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"status" => $this->status,
			"user" => $this->user ? $this->user->jsonSerialize() : null,
			"can_be_edited" => $this->canBeEdited,
			"is_anonymous" => $this->isAnonymous,
			"can_manage_chat" => $this->canManageChat,
			"can_delete_messages" => $this->canDeleteMessages,
			"can_manage_video_chats" => $this->canManageVideoChats,
			"can_restrict_members" => $this->canRestrictMembers,
			"can_promote_members" => $this->canPromoteMembers,
			"can_change_info" => $this->canChangeInfo,
			"can_invite_users" => $this->canInviteUsers,
			"can_post_stories" => $this->canPostStories,
			"can_edit_stories" => $this->canEditStories,
			"can_delete_stories" => $this->canDeleteStories,
			"can_post_messages" => $this->canPostMessages,
			"can_edit_messages" => $this->canEditMessages,
			"can_pin_messages" => $this->canPinMessages,
			"can_manage_topics" => $this->canManageTopics,
			"custom_title" => $this->customTitle,
		];
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return bool
	 */
	public function canBeEdited(): bool
	{
		return $this->canBeEdited;
	}

	/**
	 * @return bool
	 */
	public function isAnonymous(): bool
	{
		return $this->isAnonymous;
	}

	/**
	 * @return bool
	 */
	public function canManageChat(): bool
	{
		return $this->canManageChat;
	}

	/**
	 * @return bool
	 */
	public function canDeleteMessages(): bool
	{
		return $this->canDeleteMessages;
	}

	/**
	 * @return bool
	 */
	public function canManageVideoChats(): bool
	{
		return $this->canManageVideoChats;
	}

	/**
	 * @return bool
	 */
	public function canRestrictMembers(): bool
	{
		return $this->canRestrictMembers;
	}

	/**
	 * @return bool
	 */
	public function canPromoteMembers(): bool
	{
		return $this->canPromoteMembers;
	}

	/**
	 * @return bool
	 */
	public function canChangeInfo(): bool
	{
		return $this->canChangeInfo;
	}

	/**
	 * @return bool
	 */
	public function canInviteUsers(): bool
	{
		return $this->canInviteUsers;
	}

	/**
	 * @return bool
	 */
	public function canPostStories(): bool
	{
		return $this->canPostStories;
	}

	/**
	 * @return bool
	 */
	public function canEditStories(): bool
	{
		return $this->canEditStories;
	}

	/**
	 * @return bool
	 */
	public function canDeleteStories(): bool
	{
		return $this->canDeleteStories;
	}

	/**
	 * @return bool
	 */
	public function canPostMessages(): bool
	{
		return $this->canPostMessages;
	}

	/**
	 * @return bool
	 */
	public function canEditMessages(): bool
	{
		return $this->canEditMessages;
	}

	/**
	 * @return bool
	 */
	public function canPinMessages(): bool
	{
		return $this->canPinMessages;
	}

	/**
	 * @return bool
	 */
	public function canManageTopics(): bool
	{
		return $this->canManageTopics;
	}

	/**
	 * @return string
	 */
	public function getCustomTitle(): string
	{
		return $this->customTitle;
	}
}