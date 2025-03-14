<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatpermissions
 */
class ChatPermissions implements \JsonSerializable
{
	protected bool $canSendMessages;
	protected bool $canSendAudios;
	protected bool $canSendDocuments;
	protected bool $canSendPhotos;
	protected bool $canSendVideos;
	protected bool $canSendVideoNotes;
	protected bool $canSendVoiceNotes;
	protected bool $canSendPolls;
	protected bool $canSendOtherMessages;
	protected bool $canAddWebPagePreviews;
	protected bool $canChangeInfo;
	protected bool $canInviteUsers;
	protected bool $canPinMessages;
	protected bool $canManageTopics;

	public function __construct(
		bool $canSendMessages = false,
		bool $canSendAudios = false,
		bool $canSendDocuments = false,
		bool $canSendPhotos = false,
		bool $canSendVideos = false,
		bool $canSendVideoNotes = false,
		bool $canSendVoiceNotes = false,
		bool $canSendPolls = false,
		bool $canSendOtherMessages = false,
		bool $canAddWebPagePreviews = false,
		bool $canChangeInfo = false,
		bool $canInviteUsers = false,
		bool $canPinMessages = false,
		bool $canManageTopics = false
	)
	{
		$this->canSendMessages = $canSendMessages;
		$this->canSendAudios = $canSendAudios;
		$this->canSendDocuments = $canSendDocuments;
		$this->canSendPhotos = $canSendPhotos;
		$this->canSendVideos = $canSendVideos;
		$this->canSendVideoNotes = $canSendVideoNotes;
		$this->canSendVoiceNotes = $canSendVoiceNotes;
		$this->canSendPolls = $canSendPolls;
		$this->canSendOtherMessages = $canSendOtherMessages;
		$this->canAddWebPagePreviews = $canAddWebPagePreviews;
		$this->canChangeInfo = $canChangeInfo;
		$this->canInviteUsers = $canInviteUsers;
		$this->canPinMessages = $canPinMessages;
		$this->canManageTopics = $canManageTopics;
	}

	public static function fromArray(array $array): ChatPermissions
	{
		return new static(
			$array["can_send_messages"] ?? false,
			$array["can_send_audios"] ?? false,
			$array["can_send_documents"] ?? false,
			$array["can_send_photos"] ?? false,
			$array["can_send_videos"] ?? false,
			$array["can_send_video_notes"] ?? false,
			$array["can_send_voice_notes"] ?? false,
			$array["can_send_polls"] ?? false,
			$array["can_send_other_messages"] ?? false,
			$array["can_add_web_page_previews"] ?? false,
			$array["can_change_info"] ?? false,
			$array["can_invite_users"] ?? false,
			$array["can_pin_messages"] ?? false,
			$array["can_manage_topics"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"can_send_messages" => $this->canSendMessages,
			"can_send_audios" => $this->canSendAudios,
			"can_send_documents" => $this->canSendDocuments,
			"can_send_photos" => $this->canSendPhotos,
			"can_send_videos" => $this->canSendVideos,
			"can_send_video_notes" => $this->canSendVideoNotes,
			"can_send_voice_notes" => $this->canSendVoiceNotes,
			"can_send_polls" => $this->canSendPolls,
			"can_send_other_messages" => $this->canSendOtherMessages,
			"can_add_web_page_previews" => $this->canAddWebPagePreviews,
			"can_change_info" => $this->canChangeInfo,
			"can_invite_users" => $this->canInviteUsers,
			"can_pin_messages" => $this->canPinMessages,
			"can_manage_topics" => $this->canManageTopics,
		];
	}

	/**
	 * @return bool
	 */
	public function canSendMessages(): bool
	{
		return $this->canSendMessages;
	}

	/**
	 * @return bool
	 */
	public function canSendAudios(): bool
	{
		return $this->canSendAudios;
	}

	/**
	 * @return bool
	 */
	public function canSendDocuments(): bool
	{
		return $this->canSendDocuments;
	}

	/**
	 * @return bool
	 */
	public function canSendPhotos(): bool
	{
		return $this->canSendPhotos;
	}

	/**
	 * @return bool
	 */
	public function canSendVideos(): bool
	{
		return $this->canSendVideos;
	}

	/**
	 * @return bool
	 */
	public function canSendVideoNotes(): bool
	{
		return $this->canSendVideoNotes;
	}

	/**
	 * @return bool
	 */
	public function canSendVoiceNotes(): bool
	{
		return $this->canSendVoiceNotes;
	}

	/**
	 * @return bool
	 */
	public function canSendPolls(): bool
	{
		return $this->canSendPolls;
	}

	/**
	 * @return bool
	 */
	public function canSendOtherMessages(): bool
	{
		return $this->canSendOtherMessages;
	}

	/**
	 * @return bool
	 */
	public function canAddWebPagePreviews(): bool
	{
		return $this->canAddWebPagePreviews;
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
}