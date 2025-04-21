<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatfullinfo
 */
class ChatFullInfo implements \JsonSerializable
{
	protected int $id;
	protected string $type;
	protected ?string $title;
	protected ?string $username;
	protected ?string $firstName;
	protected ?string $lastName;
	protected bool $isForum;
	protected int $accentColorId;
	protected int $maxReactionCount;
	protected ?ChatPhoto $photo;
	/**
	 * @var string[]
	 */
	protected array $activeUsernames;
	protected ?Birthdate $birthdate;
	protected ?BusinessIntro $businessIntro;
	protected ?BusinessLocation $businessLocation;
	protected ?BusinessOpeningHours $businessOpeningHours;
	protected ?Chat $personalChat;
	/**
	 * @var (ReactionTypeEmoji|ReactionTypeCustomEmoji|ReactionTypePaid)[]
	 */
	protected array $availableReactions;
	protected ?string $backgroundCustomEmojiId;
	protected ?int $profileAccentColorId;
	protected ?string $profileBackgroundCustomEmojiId;
	protected ?string $emojiStatusCustomEmojiId;
	protected ?int $emojiStatusExpirationDate;
	protected ?string $bio;
	protected bool $hasPrivateForwards;
	protected bool $hasRestrictedVoiceAndVideoMessages;
	protected bool $joinToSendMessages;
	protected bool $joinByRequest;
	protected ?string $description;
	protected ?string $inviteLink;
	protected ?Message $pinnedMessage;
	protected ?ChatPermissions $permissions;
	protected bool $canSendGift;
	protected bool $canSendPaidMedia;
	protected ?int $slowModeDelay;
	protected ?int $unrestrictBoostCount;
	protected ?int $messageAutoDeleteTime;
	protected bool $hasAggressiveAntiSpamEnabled;
	protected bool $hasHiddenMembers;
	protected bool $hasProtectedContent;
	protected bool $hasVisibleHistory;
	protected ?string $stickerSetName;
	protected bool $canSetStickerSet;
	protected ?string $customEmojiStickerSetName;
	protected ?int $linkedChatId;
	protected ?ChatLocation $location;

	public function __construct(
		int $id = 0,
		string $type = "",
		?string $title = null,
		?string $username = null,
		?string $firstName = null,
		?string $lastName = null,
		bool $isForum = false,
		int $accentColorId = 0,
		int $maxReactionCount = 0,
		?ChatPhoto $photo = null,
		array $activeUsernames = [],
		?Birthdate $birthdate = null,
		?BusinessIntro $businessIntro = null,
		?BusinessLocation $businessLocation = null,
		?BusinessOpeningHours $businessOpeningHours = null,
		?Chat $personalChat = null,
		array $availableReactions = [],
		?string $backgroundCustomEmojiId = null,
		?int $profileAccentColorId = null,
		?string $profileBackgroundCustomEmojiId = null,
		?string $emojiStatusCustomEmojiId = null,
		?int $emojiStatusExpirationDate = null,
		?string $bio = null,
		bool $hasPrivateForwards = false,
		bool $hasRestrictedVoiceAndVideoMessages = false,
		bool $joinToSendMessages = false,
		bool $joinByRequest = false,
		?string $description = null,
		?string $inviteLink = null,
		?Message $pinnedMessage = null,
		?ChatPermissions $permissions = null,
		bool $canSendGift = false,
		bool $canSendPaidMedia = false,
		?int $slowModeDelay = null,
		?int $unrestrictBoostCount = null,
		?int $messageAutoDeleteTime = null,
		bool $hasAggressiveAntiSpamEnabled = false,
		bool $hasHiddenMembers = false,
		bool $hasProtectedContent = false,
		bool $hasVisibleHistory = false,
		?string $stickerSetName = null,
		bool $canSetStickerSet = false,
		?string $customEmojiStickerSetName = null,
		?int $linkedChatId = null,
		?ChatLocation $location = null
	)
	{
		$this->id = $id;
		$this->type = $type;
		$this->title = $title;
		$this->username = $username;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->isForum = $isForum;
		$this->accentColorId = $accentColorId;
		$this->maxReactionCount = $maxReactionCount;
		$this->photo = $photo;
		$this->activeUsernames = $activeUsernames;
		$this->birthdate = $birthdate;
		$this->businessIntro = $businessIntro;
		$this->businessLocation = $businessLocation;
		$this->businessOpeningHours = $businessOpeningHours;
		$this->personalChat = $personalChat;
		$this->availableReactions = $availableReactions;
		$this->backgroundCustomEmojiId = $backgroundCustomEmojiId;
		$this->profileAccentColorId = $profileAccentColorId;
		$this->profileBackgroundCustomEmojiId = $profileBackgroundCustomEmojiId;
		$this->emojiStatusCustomEmojiId = $emojiStatusCustomEmojiId;
		$this->emojiStatusExpirationDate = $emojiStatusExpirationDate;
		$this->bio = $bio;
		$this->hasPrivateForwards = $hasPrivateForwards;
		$this->hasRestrictedVoiceAndVideoMessages = $hasRestrictedVoiceAndVideoMessages;
		$this->joinToSendMessages = $joinToSendMessages;
		$this->joinByRequest = $joinByRequest;
		$this->description = $description;
		$this->inviteLink = $inviteLink;
		$this->pinnedMessage = $pinnedMessage;
		$this->permissions = $permissions;
		$this->canSendGift = $canSendGift;
		$this->canSendPaidMedia = $canSendPaidMedia;
		$this->slowModeDelay = $slowModeDelay;
		$this->unrestrictBoostCount = $unrestrictBoostCount;
		$this->messageAutoDeleteTime = $messageAutoDeleteTime;
		$this->hasAggressiveAntiSpamEnabled = $hasAggressiveAntiSpamEnabled;
		$this->hasHiddenMembers = $hasHiddenMembers;
		$this->hasProtectedContent = $hasProtectedContent;
		$this->hasVisibleHistory = $hasVisibleHistory;
		$this->stickerSetName = $stickerSetName;
		$this->canSetStickerSet = $canSetStickerSet;
		$this->customEmojiStickerSetName = $customEmojiStickerSetName;
		$this->linkedChatId = $linkedChatId;
		$this->location = $location;

		foreach ($this->activeUsernames as $activeUsername) {
			if (!is_string($activeUsername)) {
				throw new \InvalidArgumentException("Active username must be a string");
			}
		}

		foreach ($this->availableReactions as $availableReaction) {
			if (!$availableReaction instanceof ReactionTypeEmoji
				&& !$availableReaction instanceof ReactionTypeCustomEmoji
				&& !$availableReaction instanceof ReactionTypePaid) {
				throw new \InvalidArgumentException("Available reaction must be an instance of ReactionTypeEmoji, ReactionTypeCustomEmoji or ReactionTypePaid");
			}
		}
	}

	public static function fromArray(array $array): ChatFullInfo
	{
		return new static(
			$array["id"] ?? 0,
			$array["type"] ?? "",
			$array["title"],
			$array["username"],
			$array["first_name"],
			$array["last_name"],
			$array["is_forum"] ?? false,
			$array["accent_color_id"] ?? 0,
			$array["max_reaction_count"] ?? 0,
			$array["photo"] ? ChatPhoto::fromArray($array["photo"]) : null,
			$array["active_usernames"] ?? [],
			$array["birthdate"] ? Birthdate::fromArray($array["birthdate"]) : null,
			$array["business_intro"] ? BusinessIntro::fromArray($array["business_intro"]) : null,
			$array["business_location"] ? BusinessLocation::fromArray($array["business_location"]) : null,
			$array["business_opening_hours"] ? BusinessOpeningHours::fromArray($array["business_opening_hours"]) : null,
			$array["personal_chat"] ? Chat::fromArray($array["personal_chat"]) : null,
			$array["available_reactions"] ? array_map(fn($reaction) => ReactionType::fromArray($reaction), $array["available_reactions"]) : [],
			$array["background_custom_emoji_id"],
			$array["profile_accent_color_id"],
			$array["profile_background_custom_emoji_id"],
			$array["emoji_status_custom_emoji_id"],
			$array["emoji_status_expiration_date"],
			$array["bio"],
			$array["has_private_forwards"] ?? false,
			$array["has_restricted_voice_and_video_messages"] ?? false,
			$array["join_to_send_messages"] ?? false,
			$array["join_by_request"] ?? false,
			$array["description"],
			$array["invite_link"],
			$array["pinned_message"] ? Message::fromArray($array["pinned_message"]) : null,
			$array["permissions"] ? ChatPermissions::fromArray($array["permissions"]) : null,
			$array["can_send_gift"] ?? false,
			$array["can_send_paid_media"] ?? false,
			$array["slow_mode_delay"],
			$array["unrestrict_boost_count"],
			$array["message_auto_delete_time"],
			$array["has_aggressive_anti_spam_enabled"] ?? false,
			$array["has_hidden_members"] ?? false,
			$array["has_protected_content"] ?? false,
			$array["has_visible_history"] ?? false,
			$array["sticker_set_name"],
			$array["can_set_sticker_set"] ?? false,
			$array["custom_emoji_sticker_set_name"],
			$array["linked_chat_id"],
			$array["location"] ? ChatLocation::fromArray($array["location"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"type" => $this->type,
			"is_forum" => $this->isForum,
			"accent_color_id" => $this->accentColorId,
			"max_reaction_count" => $this->maxReactionCount,
			"active_usernames" => $this->activeUsernames,
			"available_reactions" => $this->availableReactions ? array_map(fn($reaction) => $reaction->jsonSerialize(), $this->availableReactions) : [],
			"has_private_forwards" => $this->hasPrivateForwards,
			"has_restricted_voice_and_video_messages" => $this->hasRestrictedVoiceAndVideoMessages,
			"join_to_send_messages" => $this->joinToSendMessages,
			"join_by_request" => $this->joinByRequest,
			"can_send_gift" => $this->canSendGift,
			"can_send_paid_media" => $this->canSendPaidMedia,
			"has_aggressive_anti_spam_enabled" => $this->hasAggressiveAntiSpamEnabled,
			"has_hidden_members" => $this->hasHiddenMembers,
			"has_protected_content" => $this->hasProtectedContent,
			"has_visible_history" => $this->hasVisibleHistory,
			"can_set_sticker_set" => $this->canSetStickerSet,
		];

		if (isset($this->title)) {
			$array["title"] = $this->title;
		}
		if (isset($this->username)) {
			$array["username"] = $this->username;
		}
		if (isset($this->firstName)) {
			$array["first_name"] = $this->firstName;
		}
		if (isset($this->lastName)) {
			$array["last_name"] = $this->lastName;
		}
		if (isset($this->photo)) {
			$array["photo"] = $this->photo->jsonSerialize();
		}
		if (isset($this->birthdate)) {
			$array["birthdate"] = $this->birthdate->jsonSerialize();
		}
		if (isset($this->businessIntro)) {
			$array["business_intro"] = $this->businessIntro->jsonSerialize();
		}
		if (isset($this->businessLocation)) {
			$array["business_location"] = $this->businessLocation->jsonSerialize();
		}
		if (isset($this->businessOpeningHours)) {
			$array["business_opening_hours"] = $this->businessOpeningHours->jsonSerialize();
		}
		if (isset($this->personalChat)) {
			$array["personal_chat"] = $this->personalChat->jsonSerialize();
		}
		if (isset($this->backgroundCustomEmojiId)) {
			$array["background_custom_emoji_id"] = $this->backgroundCustomEmojiId;
		}
		if (isset($this->profileAccentColorId)) {
			$array["profile_accent_color_id"] = $this->profileAccentColorId;
		}
		if (isset($this->profileBackgroundCustomEmojiId)) {
			$array["profile_background_custom_emoji_id"] = $this->profileBackgroundCustomEmojiId;
		}
		if (isset($this->emojiStatusCustomEmojiId)) {
			$array["emoji_status_custom_emoji_id"] = $this->emojiStatusCustomEmojiId;
		}
		if (isset($this->emojiStatusExpirationDate)) {
			$array["emoji_status_expiration_date"] = $this->emojiStatusExpirationDate;
		}
		if (isset($this->bio)) {
			$array["bio"] = $this->bio;
		}
		if (isset($this->description)) {
			$array["description"] = $this->description;
		}
		if (isset($this->inviteLink)) {
			$array["invite_link"] = $this->inviteLink;
		}
		if (isset($this->pinnedMessage)) {
			$array["pinned_message"] = $this->pinnedMessage->jsonSerialize();
		}
		if (isset($this->permissions)) {
			$array["permissions"] = $this->permissions->jsonSerialize();
		}
		if (isset($this->slowModeDelay)) {
			$array["slow_mode_delay"] = $this->slowModeDelay;
		}
		if (isset($this->unrestrictBoostCount)) {
			$array["unrestrict_boost_count"] = $this->unrestrictBoostCount;
		}
		if (isset($this->messageAutoDeleteTime)) {
			$array["message_auto_delete_time"] = $this->messageAutoDeleteTime;
		}
		if (isset($this->stickerSetName)) {
			$array["sticker_set_name"] = $this->stickerSetName;
		}
		if (isset($this->customEmojiStickerSetName)) {
			$array["custom_emoji_sticker_set_name"] = $this->customEmojiStickerSetName;
		}
		if (isset($this->linkedChatId)) {
			$array["linked_chat_id"] = $this->linkedChatId;
		}
		if (isset($this->location)) {
			$array["location"] = $this->location->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function getUsername(): ?string
	{
		return $this->username;
	}

	/**
	 * @return string|null
	 */
	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @return bool
	 */
	public function isForum(): bool
	{
		return $this->isForum;
	}

	/**
	 * @return int
	 */
	public function getAccentColorId(): int
	{
		return $this->accentColorId;
	}

	/**
	 * @return int
	 */
	public function getMaxReactionCount(): int
	{
		return $this->maxReactionCount;
	}

	/**
	 * @return ChatPhoto|null
	 */
	public function getPhoto(): ?ChatPhoto
	{
		return $this->photo;
	}

	/**
	 * @return string[]
	 */
	public function getActiveUsernames(): array
	{
		return $this->activeUsernames;
	}

	/**
	 * @return Birthdate|null
	 */
	public function getBirthdate(): ?Birthdate
	{
		return $this->birthdate;
	}

	/**
	 * @return BusinessIntro|null
	 */
	public function getBusinessIntro(): ?BusinessIntro
	{
		return $this->businessIntro;
	}

	/**
	 * @return BusinessLocation|null
	 */
	public function getBusinessLocation(): ?BusinessLocation
	{
		return $this->businessLocation;
	}

	/**
	 * @return BusinessOpeningHours|null
	 */
	public function getBusinessOpeningHours(): ?BusinessOpeningHours
	{
		return $this->businessOpeningHours;
	}

	/**
	 * @return Chat|null
	 */
	public function getPersonalChat(): ?Chat
	{
		return $this->personalChat;
	}

	/**
	 * @return (ReactionTypeEmoji|ReactionTypeCustomEmoji|ReactionTypePaid)[]
	 */
	public function getAvailableReactions(): array
	{
		return $this->availableReactions;
	}

	/**
	 * @return string|null
	 */
	public function getBackgroundCustomEmojiId(): ?string
	{
		return $this->backgroundCustomEmojiId;
	}

	/**
	 * @return int|null
	 */
	public function getProfileAccentColorId(): ?int
	{
		return $this->profileAccentColorId;
	}

	/**
	 * @return string|null
	 */
	public function getProfileBackgroundCustomEmojiId(): ?string
	{
		return $this->profileBackgroundCustomEmojiId;
	}

	/**
	 * @return string|null
	 */
	public function getEmojiStatusCustomEmojiId(): ?string
	{
		return $this->emojiStatusCustomEmojiId;
	}

	/**
	 * @return int|null
	 */
	public function getEmojiStatusExpirationDate(): ?int
	{
		return $this->emojiStatusExpirationDate;
	}

	/**
	 * @return string|null
	 */
	public function getBio(): ?string
	{
		return $this->bio;
	}

	/**
	 * @return bool
	 */
	public function hasPrivateForwards(): bool
	{
		return $this->hasPrivateForwards;
	}

	/**
	 * @return bool
	 */
	public function hasRestrictedVoiceAndVideoMessages(): bool
	{
		return $this->hasRestrictedVoiceAndVideoMessages;
	}

	/**
	 * @return bool
	 */
	public function isJoinToSendMessages(): bool
	{
		return $this->joinToSendMessages;
	}

	/**
	 * @return bool
	 */
	public function isJoinByRequest(): bool
	{
		return $this->joinByRequest;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @return string|null
	 */
	public function getInviteLink(): ?string
	{
		return $this->inviteLink;
	}

	/**
	 * @return Message|null
	 */
	public function getPinnedMessage(): ?Message
	{
		return $this->pinnedMessage;
	}

	/**
	 * @return ChatPermissions|null
	 */
	public function getPermissions(): ?ChatPermissions
	{
		return $this->permissions;
	}

	/**
	 * @return bool
	 */
	public function isCanSendGift(): bool
	{
		return $this->canSendGift;
	}

	/**
	 * @return bool
	 */
	public function isCanSendPaidMedia(): bool
	{
		return $this->canSendPaidMedia;
	}

	/**
	 * @return int|null
	 */
	public function getSlowModeDelay(): ?int
	{
		return $this->slowModeDelay;
	}

	/**
	 * @return int|null
	 */
	public function getUnrestrictBoostCount(): ?int
	{
		return $this->unrestrictBoostCount;
	}

	/**
	 * @return int|null
	 */
	public function getMessageAutoDeleteTime(): ?int
	{
		return $this->messageAutoDeleteTime;
	}

	/**
	 * @return bool
	 */
	public function hasAggressiveAntiSpamEnabled(): bool
	{
		return $this->hasAggressiveAntiSpamEnabled;
	}

	/**
	 * @return bool
	 */
	public function hasHiddenMembers(): bool
	{
		return $this->hasHiddenMembers;
	}

	/**
	 * @return bool
	 */
	public function hasProtectedContent(): bool
	{
		return $this->hasProtectedContent;
	}

	/**
	 * @return bool
	 */
	public function hasVisibleHistory(): bool
	{
		return $this->hasVisibleHistory;
	}

	/**
	 * @return string|null
	 */
	public function getStickerSetName(): ?string
	{
		return $this->stickerSetName;
	}

	/**
	 * @return bool
	 */
	public function isCanSetStickerSet(): bool
	{
		return $this->canSetStickerSet;
	}

	/**
	 * @return string|null
	 */
	public function getCustomEmojiStickerSetName(): ?string
	{
		return $this->customEmojiStickerSetName;
	}

	/**
	 * @return int|null
	 */
	public function getLinkedChatId(): ?int
	{
		return $this->linkedChatId;
	}

	/**
	 * @return ChatLocation|null
	 */
	public function getLocation(): ?ChatLocation
	{
		return $this->location;
	}
}