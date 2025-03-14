<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#message
 */
class Message implements \JsonSerializable
{
	protected int $messageId;
	protected ?int $messageThreadId;
	protected ?User $from;
	protected ?Chat $se;
	protected ?int $senderBoostCount;
	protected ?User $senderBusinessBot;
	protected int $date;
	protected ?string $businessConnectionId;
	protected Chat $chat;
	protected ?MessageOrigin $forwardOrigin;
	protected bool $isTopicMessage;
	protected bool $isAutomaticForward;
	protected ?Message $replyToMessage;
	protected ?ExternalReplyInfo $externalReply;
	protected ?TextQuote $quote;
	protected ?Story $replyToStory;
	protected ?User $viaBot;
	protected ?int $editDate;
	protected bool $hasProtectedContent;
	protected bool $isFromOffline;
	protected ?string $mediaGroupId;
	protected ?string $authorSignature;
	protected ?string $text;
	/**
	 * @var MessageEntity[]
	 */
	protected array $entities;
	protected ?LinkPreviewOptions $linkPreviewOptions;
	protected ?string $effectId;
	protected ?Animation $animation;
	protected ?Audio $audio;
	protected ?Document $document;
	protected ?PaidMediaInfo $paidMedia;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;
	protected ?Sticker $sticker;
	protected ?Story $story;
	protected ?Video $video;
	protected ?VideoNote $videoNote;
	protected ?Voice $voice;
	protected ?string $caption;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected bool $showCaptionAboveMedia;
	protected bool $hasMediaSpoiler;
	protected ?Contact $contact;
	protected ?Dice $dice;
	protected ?Game $game;
	protected ?Poll $poll;
	protected ?Venue $venue;
	protected ?Location $location;
	/**
	 * @var User[]
	 */
	protected array $newChatMembers;
	protected ?User $leftChatMember;
	protected ?string $newChatTitle;
	/**
	 * @var PhotoSize[]
	 */
	protected array $newChatPhoto;
	protected bool $deleteChatPhoto;
	protected bool $groupChatCreated;
	protected bool $supergroupChatCreated;
	protected bool $channelChatCreated;
	protected ?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged;
	protected ?int $migrateToChatId;
	protected ?int $migrateFromChatId;
	protected ?MaybeInaccessibleMessage $pinnedMessage;
	protected ?Invoice $invoice;
	protected ?SuccessfulPayment $successfulPayment;
	protected ?RefundedPayment $refundedPayment;
	protected ?UsersShared $usersShared;
	protected ?ChatShared $chatShared;
	protected ?string $connectedWebsite;
	protected ?WriteAccessAllowed $writeAccessAllowed;
	protected ?PassportData $passportData;
	protected ?ProximityAlertTriggered $proximityAlertTriggered;
	protected ?ChatBoostAdded $boostAdded;
	protected ?ChatBackground $chatBackgroundSet;
	protected ?ForumTopicCreated $forumTopicCreated;
	protected ?ForumTopicEdited $forumTopicEdited;
	protected ?ForumTopicClosed $forumTopicClosed;
	protected ?ForumTopicReopened $forumTopicReopened;
	protected ?GeneralForumTopicHidden $generalForumTopicHidden;
	protected ?GeneralForumTopicUnhidden $generalForumTopicUnhidden;
	protected ?GiveawayCreated $giveawayCreated;
	protected ?Giveaway $giveaway;
	protected ?GiveawayWinners $giveawayWinners;
	protected ?GiveawayCompleted $giveawayCompleted;
	protected ?VideoChatScheduled $videoChatScheduled;
	protected ?VideoChatStarted $videoChatStarted;
	protected ?VideoChatEnded $videoChatEnded;
	protected ?VideoChatParticipantsInvited $videoChatParticipantsInvited;
	protected ?WebAppData $webAppData;
	protected ?InlineKeyboardMarkup $replyMarkup;

	public function __construct(
		int $messageId = 0,
		?int $messageThreadId = null,
		?User $from = null,
		?Chat $senderChat = null,
		?int $senderBoostCount = null,
		?User $senderBusinessBot = null,
		int $date = 0,
		?string $businessConnectionId = null,
		Chat $chat = null,
		?MessageOrigin $forwardOrigin = null,
		bool $isTopicMessage = false,
		bool $isAutomaticForward = false,
		?Message $replyToMessage = null,
		?ExternalReplyInfo $externalReply = null,
		?TextQuote $quote = null,
		?Story $replyToStory = null,
		?User $viaBot = null,
		?int $editDate = null,
		bool $hasProtectedContent = false,
		bool $isFromOffline = false,
		?string $mediaGroupId = null,
		?string $authorSignature = null,
		?string $text = null,
		array $entities = [],
		?LinkPreviewOptions $linkPreviewOptions = null,
		?string $effectId = null,
		?Animation $animation = null,
		?Audio $audio = null,
		?Document $document = null,
		?PaidMediaInfo $paidMedia = null,
		array $photo = [],
		?Sticker $sticker = null,
		?Story $story = null,
		?Video $video = null,
		?VideoNote $videoNote = null,
		?Voice $voice = null,
		?string $caption = null,
		array $captionEntities = [],
		bool $showCaptionAboveMedia = false,
		bool $hasMediaSpoiler = false,
		?Contact $contact = null,
		?Dice $dice = null,
		?Game $game = null,
		?Poll $poll = null,
		?Venue $venue = null,
		?Location $location = null,
		array $newChatMembers = [],
		?User $leftChatMember = null,
		?string $newChatTitle = null,
		array $newChatPhoto = [],
		bool $deleteChatPhoto = false,
		bool $groupChatCreated = false,
		bool $supergroupChatCreated = false,
		bool $channelChatCreated = false,
		?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged = null,
		?int $migrateToChatId = null,
		?int $migrateFromChatId = null,
		?MaybeInaccessibleMessage $pinnedMessage = null,
		?Invoice $invoice = null,
		?SuccessfulPayment $successfulPayment = null,
		?RefundedPayment $refundedPayment = null,
		?UsersShared $usersShared = null,
		?ChatShared $chatShared = null,
		?string $connectedWebsite = null,
		?WriteAccessAllowed $writeAccessAllowed = null,
		?PassportData $passportData = null,
		?ProximityAlertTriggered $proximityAlertTriggered = null,
		?ChatBoostAdded $boostAdded = null,
		?ChatBackground $chatBackgroundSet = null,
		?ForumTopicCreated $forumTopicCreated = null,
		?ForumTopicEdited $forumTopicEdited = null,
		?ForumTopicClosed $forumTopicClosed = null,
		?ForumTopicReopened $forumTopicReopened = null,
		?GeneralForumTopicHidden $generalForumTopicHidden = null,
		?GeneralForumTopicUnhidden $generalForumTopicUnhidden = null,
		?GiveawayCreated $giveawayCreated = null,
		?Giveaway $giveaway = null,
		?GiveawayWinners $giveawayWinners = null,
		?GiveawayCompleted $giveawayCompleted = null,
		?VideoChatScheduled $videoChatScheduled = null,
		?VideoChatStarted $videoChatStarted = null,
		?VideoChatEnded $videoChatEnded = null,
		?VideoChatParticipantsInvited $videoChatParticipantsInvited = null,
		?WebAppData $webAppData = null,
		?InlineKeyboardMarkup $replyMarkup = null
	)
	{
		$this->messageId = $messageId;
		$this->messageThreadId = $messageThreadId;
		$this->from = $from;
		$this->senderChat = $senderChat;
		$this->senderBoostCount = $senderBoostCount;
		$this->senderBusinessBot = $senderBusinessBot;
		$this->date = $date;
		$this->businessConnectionId = $businessConnectionId;
		$this->chat = $chat;
		$this->forwardOrigin = $forwardOrigin;
		$this->isTopicMessage = $isTopicMessage;
		$this->isAutomaticForward = $isAutomaticForward;
		$this->replyToMessage = $replyToMessage;
		$this->externalReply = $externalReply;
		$this->quote = $quote;
		$this->replyToStory = $replyToStory;
		$this->viaBot = $viaBot;
		$this->editDate = $editDate;
		$this->hasProtectedContent = $hasProtectedContent;
		$this->text = $text;
		$this->authorSignature = $authorSignature;
		$this->mediaGroupId = $mediaGroupId;
		$this->isFromOffline = $isFromOffline;
		$this->entities = $entities;
		$this->linkPreviewOptions = $linkPreviewOptions;
		$this->effectId = $effectId;
		$this->animation = $animation;
		$this->audio = $audio;
		$this->document = $document;
		$this->paidMedia = $paidMedia;
		$this->photo = $photo;
		$this->sticker = $sticker;
		$this->story = $story;
		$this->video = $video;
		$this->videoNote = $videoNote;
		$this->voice = $voice;
		$this->caption = $caption;
		$this->captionEntities = $captionEntities;
		$this->showCaptionAboveMedia = $showCaptionAboveMedia;
		$this->hasMediaSpoiler = $hasMediaSpoiler;
		$this->contact = $contact;
		$this->dice = $dice;
		$this->game = $game;
		$this->poll = $poll;
		$this->venue = $venue;
		$this->location = $location;
		$this->newChatMembers = $newChatMembers;
		$this->leftChatMember = $leftChatMember;
		$this->newChatTitle = $newChatTitle;
		$this->newChatPhoto = $newChatPhoto;
		$this->deleteChatPhoto = $deleteChatPhoto;
		$this->groupChatCreated = $groupChatCreated;
		$this->supergroupChatCreated = $supergroupChatCreated;
		$this->channelChatCreated = $channelChatCreated;
		$this->messageAutoDeleteTimerChanged = $messageAutoDeleteTimerChanged;
		$this->migrateToChatId = $migrateToChatId;
		$this->migrateFromChatId = $migrateFromChatId;
		$this->pinnedMessage = $pinnedMessage;
		$this->invoice = $invoice;
		$this->successfulPayment = $successfulPayment;
		$this->refundedPayment = $refundedPayment;
		$this->usersShared = $usersShared;
		$this->chatShared = $chatShared;
		$this->connectedWebsite = $connectedWebsite;
		$this->writeAccessAllowed = $writeAccessAllowed;
		$this->passportData = $passportData;
		$this->proximityAlertTriggered = $proximityAlertTriggered;
		$this->boostAdded = $boostAdded;
		$this->chatBackgroundSet = $chatBackgroundSet;
		$this->forumTopicCreated = $forumTopicCreated;
		$this->forumTopicEdited = $forumTopicEdited;
		$this->forumTopicClosed = $forumTopicClosed;
		$this->forumTopicReopened = $forumTopicReopened;
		$this->generalForumTopicHidden = $generalForumTopicHidden;
		$this->generalForumTopicUnhidden = $generalForumTopicUnhidden;
		$this->giveawayCreated = $giveawayCreated;
		$this->giveaway = $giveaway;
		$this->giveawayWinners = $giveawayWinners;
		$this->giveawayCompleted = $giveawayCompleted;
		$this->videoChatScheduled = $videoChatScheduled;
		$this->videoChatStarted = $videoChatStarted;
		$this->videoChatEnded = $videoChatEnded;
		$this->videoChatParticipantsInvited = $videoChatParticipantsInvited;
		$this->webAppData = $webAppData;
		$this->replyMarkup = $replyMarkup;

		foreach ($this->newChatPhoto as $chatPhoto) {
			if (!$chatPhoto instanceof PhotoSize) {
				throw new \InvalidArgumentException("Invalid chat photo must instance of " . PhotoSize::class);
			}
		}

		foreach ($this->newChatMembers as $chatMember) {
			if (!$chatMember instanceof User) {
				throw new \InvalidArgumentException("Invalid chat photo must instance of " . User::class);
			}
		}

		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("Invalid caption entity must instance of " . MessageEntity::class);
			}
		}

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("Invalid photo must instance of " . PhotoSize::class);
			}
		}

		foreach ($this->entities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("Invalid entity must instance of " . MessageEntity::class);
			}
		}
	}
	
	public static function fromArray(array $array): Message
	{
		return new static(
			$array["message_id"] ?? 0,
			$array["message_thread_id"],
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["sender_chat"] ? Chat::fromArray($array["sender_chat"]) : null,
			$array["sender_boost_count"],
			$array["sender_business_bot"] ? User::fromArray($array["sender_business_bot"]) : null,
			$array["date"],
			$array["business_connection_id"],
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["forward_origin"] ? MessageOrigin::fromArray($array["forward_origin"]) : null,
			$array["is_topic_message"] ?? false,
			$array["is_automatic_forward"] ?? false,
			$array["reply_to_message"] ? Message::fromArray($array["reply_to_message"]) : null,
			$array["external_reply"] ? ExternalReplyInfo::fromArray($array["external_reply"]) : null,
			$array["quote"] ? TextQuote::fromArray($array["quote"]) : null,
			$array["reply_to_story"] ? Story::fromArray($array["reply_to_story"]) : null,
			$array["via_bot"] ? User::fromArray($array["via_bot"]) : null,
			$array["edit_date"],
			$array["has_protected_content"] ?? false,
			$array["text"] ?? false,
			$array["author_signature"],
			$array["media_group_id"],
			$array["is_from_offline"],
			$array["entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["entities"]) : [],
			$array["link_preview_options"] ? LinkPreviewOptions::fromArray($array["link_preview_options"]) : null,
			$array["effect_id"],
			$array["animation"] ? Animation::fromArray($array["animation"]) : null,
			$array["audio"] ? Audio::fromArray($array["audio"]) : null,
			$array["document"] ? Document::fromArray($array["document"]) : null,
			$array["paid_media"] ? PaidMediaInfo::fromArray($array["paid_media"]) : null,
			$array["photo"] ? array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photo"]) : [],
			$array["sticker"] ? Sticker::fromArray($array["sticker"]) : null,
			$array["story"] ? Story::fromArray($array["story"]) : null,
			$array["video"] ? Video::fromArray($array["video"]) : null,
			$array["video_note"] ? VideoNote::fromArray($array["video_note"]) : null,
			$array["voice"] ? Voice::fromArray($array["voice"]) : null,
			$array["caption"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["show_caption_above_media"] ?? false,
			$array["has_media_spoiler"] ?? false,
			$array["contact"] ? Contact::fromArray($array["contact"]) : null,
			$array["dice"] ? Dice::fromArray($array["dice"]) : null,
			$array["game"] ? Game::fromArray($array["game"]) : null,
			$array["poll"] ? Poll::fromArray($array["poll"]) : null,
			$array["venue"] ? Venue::fromArray($array["venue"]) : null,
			$array["location"] ? Location::fromArray($array["location"]) : null,
			$array["new_chat_members"] ? array_map(fn($member) => User::fromArray($member), $array["new_chat_members"]) : [],
			$array["left_chat_member"] ? User::fromArray($array["left_chat_member"]) : null,
			$array["new_chat_title"],
			$array["new_chat_photo"] ? array_map(fn($photo) => PhotoSize::fromArray($photo), $array["new_chat_photo"]) : [],
			$array["delete_chat_photo"] ?? false,
			$array["group_chat_created"] ?? false,
			$array["supergroup_chat_created"] ?? false,
			$array["channel_chat_created"] ?? false,
			$array["message_auto_delete_timer_changed"] ? MessageAutoDeleteTimerChanged::fromArray($array["message_auto_delete_timer_changed"]) : null,
			$array["migrate_to_chat_id"],
			$array["migrate_from_chat_id"],
			$array["pinned_message"] ? MaybeInaccessibleMessage::fromArray($array["pinned_message"]) : null,
			$array["invoice"] ? Invoice::fromArray($array["invoice"]) : null,
			$array["successful_payment"] ? SuccessfulPayment::fromArray($array["successful_payment"]) : null,
			$array["refunded_payment"] ? RefundedPayment::fromArray($array["refunded_payment"]) : null,
			$array["users_shared"] ? UsersShared::fromArray($array["users_shared"]) : null,
			$array["chat_shared"] ? ChatShared::fromArray($array["chat_shared"]) : null,
			$array["connected_website"],
			$array["write_access_allowed"] ? WriteAccessAllowed::fromArray($array["write_access_allowed"]) : null,
			$array["passport_data"] ? PassportData::fromArray($array["passport_data"]) : null,
			$array["proximity_alert_triggered"] ? ProximityAlertTriggered::fromArray($array["proximity_alert_triggered"]) : null,
			$array["boost_added"] ? ChatBoostAdded::fromArray($array["boost_added"]) : null,
			$array["chat_background_set"] ? ChatBackground::fromArray($array["chat_background_set"]) : null,
			$array["forum_topic_created"] ? ForumTopicCreated::fromArray($array["forum_topic_created"]) : null,
			$array["forum_topic_edited"] ? ForumTopicEdited::fromArray($array["forum_topic_edited"]) : null,
			$array["forum_topic_closed"] ? ForumTopicClosed::fromArray($array["forum_topic_closed"]) : null,
			$array["forum_topic_reopened"] ? ForumTopicReopened::fromArray($array["forum_topic_reopened"]) : null,
			$array["general_forum_topic_hidden"] ? GeneralForumTopicHidden::fromArray($array["general_forum_topic_hidden"]) : null,
			$array["general_forum_topic_unhidden"] ? GeneralForumTopicUnhidden::fromArray($array["general_forum_topic_unhidden"]) : null,
			$array["giveaway_created"] ? GiveawayCreated::fromArray($array["giveaway_created"]) : null,
			$array["giveaway"] ? Giveaway::fromArray($array["giveaway"]) : null,
			$array["giveaway_winners"] ? GiveawayWinners::fromArray($array["giveaway_winners"]) : null,
			$array["giveaway_completed"] ? GiveawayCompleted::fromArray($array["giveaway_completed"]) : null,
			$array["video_chat_scheduled"] ? VideoChatScheduled::fromArray($array["video_chat_scheduled"]) : null,
			$array["video_chat_started"] ? VideoChatStarted::fromArray($array["video_chat_started"]) : null,
			$array["video_chat_ended"] ? VideoChatEnded::fromArray($array["video_chat_ended"]) : null,
			$array["video_chat_participants_invited"] ? VideoChatParticipantsInvited::fromArray($array["video_chat_participants_invited"]) : null,
			$array["web_app_data"] ? WebAppData::fromArray($array["web_app_data"]) : null,
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"message_id" => $this->messageId,
			"message_thread_id" => $this->messageThreadId,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"sender_chat" => $this->senderChat ? $this->senderChat->jsonSerialize() : null,
			"sender_boost_count" => $this->senderBoostCount,
			"sender_business_bot" => $this->senderBusinessBot ? $this->senderBusinessBot->jsonSerialize() : null,
			"date" => $this->date,
			"business_connection_id" => $this->businessConnectionId,
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"forward_origin" => $this->forwardOrigin ? $this->forwardOrigin->jsonSerialize() : null,
			"is_topic_message" => $this->isTopicMessage,
			"is_automatic_forward" => $this->isAutomaticForward,
			"reply_to_message" => $this->replyToMessage ? $this->replyToMessage->jsonSerialize() : null,
			"external_reply" => $this->externalReply ? $this->externalReply->jsonSerialize() : null,
			"quote" => $this->quote ? $this->quote->jsonSerialize() : null,
			"reply_to_story" => $this->replyToStory ? $this->replyToStory->jsonSerialize() : null,
			"via_bot" => $this->viaBot ? $this->viaBot->jsonSerialize() : null,
			"edit_date" => $this->editDate,
			"has_protected_content" => $this->hasProtectedContent,
			"is_from_offline" => $this->isFromOffline,
			"media_group_id" => $this->mediaGroupId,
			"author_signature" => $this->authorSignature,
			"text" => $this->text,
			"entities" => $this->entities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->entities) : [],
			"link_preview_options" => $this->linkPreviewOptions ? $this->linkPreviewOptions->jsonSerialize() : null,
			"effect_id" => $this->effectId,
			"animation" => $this->animation ? $this->animation->jsonSerialize() : null,
			"audio" => $this->audio ? $this->audio->jsonSerialize() : null,
			"document" => $this->document ? $this->document->jsonSerialize() : null,
			"paid_media" => $this->paidMedia ? $this->paidMedia->jsonSerialize() : null,
			"photo" => $this->photo ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photo) : [],
			"sticker" => $this->sticker ? $this->sticker->jsonSerialize() : null,
			"story" => $this->story ? $this->story->jsonSerialize() : null,
			"video" => $this->video ? $this->video->jsonSerialize() : null,
			"video_note" => $this->videoNote ? $this->videoNote->jsonSerialize() : null,
			"voice" => $this->voice ? $this->voice->jsonSerialize() : null,
			"caption" => $this->caption,
			"caption_entities" => $this->captionEntities ? array_map(fn($caption) => $caption->jsonSerialize(), $this->captionEntities) : [],
			"show_caption_above_media" => $this->showCaptionAboveMedia,
			"has_media_spoiler" => $this->hasMediaSpoiler,
			"contact" => $this->contact ? $this->contact->jsonSerialize() : null,
			"dice" => $this->dice ? $this->dice->jsonSerialize() : null,
			"game" => $this->game ? $this->game->jsonSerialize() : null,
			"poll" => $this->poll ? $this->poll->jsonSerialize() : null,
			"venue" => $this->venue ? $this->venue->jsonSerialize() : null,
			"location" => $this->location ? $this->location->jsonSerialize() : null,
			"new_chat_members" => $this->newChatMembers ? array_map(fn($user) => $user->jsonSerialize(), $this->newChatMembers) : [],
			"left_chat_member" => $this->leftChatMember ? $this->leftChatMember->jsonSerialize() : null,
			"new_chat_title" => $this->newChatTitle,
			"new_chat_photo" => $this->newChatPhoto ? array_map(fn($photo) => $photo->jsonSerialize(), $this->newChatPhoto) : [],
			"delete_chat_photo" => $this->deleteChatPhoto,
			"group_chat_created" => $this->groupChatCreated,
			"supergroup_chat_created" => $this->supergroupChatCreated,
			"channel_chat_created" => $this->channelChatCreated,
			"message_auto_delete_timer_changed" => $this->messageAutoDeleteTimerChanged ? $this->messageAutoDeleteTimerChanged->jsonSerialize() : null,
			"migrate_to_chat_id" => $this->migrateToChatId,
			"migrate_from_chat_id" => $this->migrateFromChatId,
			"pinned_message" => $this->pinnedMessage ? $this->pinnedMessage->jsonSerialize() : null,
			"invoice" => $this->invoice ? $this->invoice->jsonSerialize() : null,
			"successful_payment" => $this->successfulPayment ? $this->successfulPayment->jsonSerialize() : null,
			"refunded_payment" => $this->refundedPayment ? $this->refundedPayment->jsonSerialize() : null,
			"users_shared" => $this->usersShared ? $this->usersShared->jsonSerialize() : null,
			"chat_shared" => $this->chatShared ? $this->chatShared->jsonSerialize() : null,
			"connected_website" => $this->connectedWebsite,
			"write_access_allowed" => $this->writeAccessAllowed ? $this->writeAccessAllowed->jsonSerialize() : null,
			"passport_data" => $this->passportData ? $this->passportData->jsonSerialize() : null,
			"proximity_alert_triggered" => $this->proximityAlertTriggered ? $this->proximityAlertTriggered->jsonSerialize() : null,
			"boost_added" => $this->boostAdded ? $this->boostAdded->jsonSerialize() : null,
			"chat_background_set" => $this->chatBackgroundSet ? $this->chatBackgroundSet->jsonSerialize() : null,
			"forum_topic_created" => $this->forumTopicCreated ? $this->forumTopicCreated->jsonSerialize() : null,
			"forum_topic_edited" => $this->forumTopicEdited ? $this->forumTopicEdited->jsonSerialize() : null,
			"forum_topic_closed" => $this->forumTopicClosed ? $this->forumTopicClosed->jsonSerialize() : null,
			"forum_topic_reopened" => $this->forumTopicReopened ? $this->forumTopicReopened->jsonSerialize() : null,
			"general_forum_topic_hidden" => $this->generalForumTopicHidden ? $this->generalForumTopicHidden->jsonSerialize() : null,
			"general_forum_topic_unhidden" => $this->generalForumTopicUnhidden ? $this->generalForumTopicUnhidden->jsonSerialize() : null,
			"giveaway_created" => $this->giveawayCreated ? $this->giveawayCreated->jsonSerialize() : null,
			"giveaway" => $this->giveaway ? $this->giveaway->jsonSerialize() : null,
			"giveaway_winners" => $this->giveawayWinners ? $this->giveawayWinners->jsonSerialize() : null,
			"giveaway_completed" => $this->giveawayCompleted ? $this->giveawayCompleted->jsonSerialize() : null,
			"video_chat_scheduled" => $this->videoChatScheduled ? $this->videoChatScheduled->jsonSerialize() : null,
			"video_chat_started" => $this->videoChatStarted ? $this->videoChatStarted->jsonSerialize() : null,
			"video_chat_ended" => $this->videoChatEnded ? $this->videoChatEnded->jsonSerialize() : null,
			"video_chat_participants_invited" => $this->videoChatParticipantsInvited ? $this->videoChatParticipantsInvited->jsonSerialize() : null,
			"web_app_data" => $this->webAppData ? $this->webAppData->jsonSerialize() : null,
			"reply_markup" => $this->replyMarkup ? $this->replyMarkup->jsonSerialize() : null,
		];
	}

	/**
	 * @return int
	 */
	public function getMessageId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return int|null
	 */
	public function getMessageThreadId(): ?int
	{
		return $this->messageThreadId;
	}

	/**
	 * @return User|null
	 */
	public function getFrom(): ?User
	{
		return $this->from;
	}

	/**
	 * @return Chat|null
	 */
	public function getSe(): ?Chat
	{
		return $this->se;
	}

	/**
	 * @return int|null
	 */
	public function getSenderBoostCount(): ?int
	{
		return $this->senderBoostCount;
	}

	/**
	 * @return User|null
	 */
	public function getSenderBusinessBot(): ?User
	{
		return $this->senderBusinessBot;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return string|null
	 */
	public function getBusinessConnectionId(): ?string
	{
		return $this->businessConnectionId;
	}

	/**
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return MessageOrigin|null
	 */
	public function getForwardOrigin(): ?MessageOrigin
	{
		return $this->forwardOrigin;
	}

	/**
	 * @return bool
	 */
	public function isTopicMessage(): bool
	{
		return $this->isTopicMessage;
	}

	/**
	 * @return bool
	 */
	public function isAutomaticForward(): bool
	{
		return $this->isAutomaticForward;
	}

	/**
	 * @return Message|null
	 */
	public function getReplyToMessage(): ?Message
	{
		return $this->replyToMessage;
	}

	/**
	 * @return ExternalReplyInfo|null
	 */
	public function getExternalReply(): ?ExternalReplyInfo
	{
		return $this->externalReply;
	}

	/**
	 * @return TextQuote|null
	 */
	public function getQuote(): ?TextQuote
	{
		return $this->quote;
	}

	/**
	 * @return Story|null
	 */
	public function getReplyToStory(): ?Story
	{
		return $this->replyToStory;
	}

	/**
	 * @return User|null
	 */
	public function getViaBot(): ?User
	{
		return $this->viaBot;
	}

	/**
	 * @return int|null
	 */
	public function getEditDate(): ?int
	{
		return $this->editDate;
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
	public function isFromOffline(): bool
	{
		return $this->isFromOffline;
	}

	/**
	 * @return string|null
	 */
	public function getMediaGroupId(): ?string
	{
		return $this->mediaGroupId;
	}

	/**
	 * @return string|null
	 */
	public function getAuthorSignature(): ?string
	{
		return $this->authorSignature;
	}

	/**
	 * @return string|null
	 */
	public function getText(): ?string
	{
		return $this->text;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getEntities(): array
	{
		return $this->entities;
	}

	/**
	 * @return LinkPreviewOptions|null
	 */
	public function getLinkPreviewOptions(): ?LinkPreviewOptions
	{
		return $this->linkPreviewOptions;
	}

	/**
	 * @return string|null
	 */
	public function getEffectId(): ?string
	{
		return $this->effectId;
	}

	/**
	 * @return Animation|null
	 */
	public function getAnimation(): ?Animation
	{
		return $this->animation;
	}

	/**
	 * @return Audio|null
	 */
	public function getAudio(): ?Audio
	{
		return $this->audio;
	}

	/**
	 * @return Document|null
	 */
	public function getDocument(): ?Document
	{
		return $this->document;
	}

	/**
	 * @return PaidMediaInfo|null
	 */
	public function getPaidMedia(): ?PaidMediaInfo
	{
		return $this->paidMedia;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getPhoto(): array
	{
		return $this->photo;
	}

	/**
	 * @return Sticker|null
	 */
	public function getSticker(): ?Sticker
	{
		return $this->sticker;
	}

	/**
	 * @return Story|null
	 */
	public function getStory(): ?Story
	{
		return $this->story;
	}

	/**
	 * @return Video|null
	 */
	public function getVideo(): ?Video
	{
		return $this->video;
	}

	/**
	 * @return VideoNote|null
	 */
	public function getVideoNote(): ?VideoNote
	{
		return $this->videoNote;
	}

	/**
	 * @return Voice|null
	 */
	public function getVoice(): ?Voice
	{
		return $this->voice;
	}

	/**
	 * @return string|null
	 */
	public function getCaption(): ?string
	{
		return $this->caption;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getCaptionEntities(): array
	{
		return $this->captionEntities;
	}

	/**
	 * @return bool
	 */
	public function isShowCaptionAboveMedia(): bool
	{
		return $this->showCaptionAboveMedia;
	}

	/**
	 * @return bool
	 */
	public function hasMediaSpoiler(): bool
	{
		return $this->hasMediaSpoiler;
	}

	/**
	 * @return Contact|null
	 */
	public function getContact(): ?Contact
	{
		return $this->contact;
	}

	/**
	 * @return Dice|null
	 */
	public function getDice(): ?Dice
	{
		return $this->dice;
	}

	/**
	 * @return Game|null
	 */
	public function getGame(): ?Game
	{
		return $this->game;
	}

	/**
	 * @return Poll|null
	 */
	public function getPoll(): ?Poll
	{
		return $this->poll;
	}

	/**
	 * @return Venue|null
	 */
	public function getVenue(): ?Venue
	{
		return $this->venue;
	}

	/**
	 * @return Location|null
	 */
	public function getLocation(): ?Location
	{
		return $this->location;
	}

	/**
	 * @return User[]
	 */
	public function getNewChatMembers(): array
	{
		return $this->newChatMembers;
	}

	/**
	 * @return User|null
	 */
	public function getLeftChatMember(): ?User
	{
		return $this->leftChatMember;
	}

	/**
	 * @return string|null
	 */
	public function getNewChatTitle(): ?string
	{
		return $this->newChatTitle;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getNewChatPhoto(): array
	{
		return $this->newChatPhoto;
	}

	/**
	 * @return bool
	 */
	public function isDeleteChatPhoto(): bool
	{
		return $this->deleteChatPhoto;
	}

	/**
	 * @return bool
	 */
	public function isGroupChatCreated(): bool
	{
		return $this->groupChatCreated;
	}

	/**
	 * @return bool
	 */
	public function isSupergroupChatCreated(): bool
	{
		return $this->supergroupChatCreated;
	}

	/**
	 * @return bool
	 */
	public function isChannelChatCreated(): bool
	{
		return $this->channelChatCreated;
	}

	/**
	 * @return MessageAutoDeleteTimerChanged|null
	 */
	public function getMessageAutoDeleteTimerChanged(): ?MessageAutoDeleteTimerChanged
	{
		return $this->messageAutoDeleteTimerChanged;
	}

	/**
	 * @return int|null
	 */
	public function getMigrateToChatId(): ?int
	{
		return $this->migrateToChatId;
	}

	/**
	 * @return int|null
	 */
	public function getMigrateFromChatId(): ?int
	{
		return $this->migrateFromChatId;
	}

	/**
	 * @return MaybeInaccessibleMessage|null
	 */
	public function getPinnedMessage(): ?MaybeInaccessibleMessage
	{
		return $this->pinnedMessage;
	}

	/**
	 * @return Invoice|null
	 */
	public function getInvoice(): ?Invoice
	{
		return $this->invoice;
	}

	/**
	 * @return SuccessfulPayment|null
	 */
	public function getSuccessfulPayment(): ?SuccessfulPayment
	{
		return $this->successfulPayment;
	}

	/**
	 * @return RefundedPayment|null
	 */
	public function getRefundedPayment(): ?RefundedPayment
	{
		return $this->refundedPayment;
	}

	/**
	 * @return UsersShared|null
	 */
	public function getUsersShared(): ?UsersShared
	{
		return $this->usersShared;
	}

	/**
	 * @return ChatShared|null
	 */
	public function getChatShared(): ?ChatShared
	{
		return $this->chatShared;
	}

	/**
 	* @return string|null
 	*/
	public function getConnectedWebsite(): ?string
	{
		return $this->connectedWebsite;
	}

	/**
 	* @return WriteAccessAllowed|null
 	*/
	public function getWriteAccessAllowed(): ?WriteAccessAllowed
	{
		return $this->writeAccessAllowed;
	}

	/**
 	* @return PassportData|null
 	*/
	public function getPassportData(): ?PassportData
	{
		return $this->passportData;
	}

	/**
 	* @return ProximityAlertTriggered|null
 	*/
	public function getProximityAlertTriggered(): ?ProximityAlertTriggered
	{
		return $this->proximityAlertTriggered;
	}

	/**
 	* @return ChatBoostAdded|null
 	*/
	public function getBoostAdded(): ?ChatBoostAdded
	{
		return $this->boostAdded;
	}

	/**
 	* @return ChatBackground|null
 	*/
	public function getChatBackgroundSet(): ?ChatBackground
	{
		return $this->chatBackgroundSet;
	}

	/**
 	* @return ForumTopicCreated|null
 	*/
	public function getForumTopicCreated(): ?ForumTopicCreated
	{
		return $this->forumTopicCreated;
	}

	/**
 	* @return ForumTopicEdited|null
 	*/
	public function getForumTopicEdited(): ?ForumTopicEdited
	{
		return $this->forumTopicEdited;
	}

	/**
 	* @return ForumTopicClosed|null
 	*/
	public function getForumTopicClosed(): ?ForumTopicClosed
	{
		return $this->forumTopicClosed;
	}

	/**
 	* @return ForumTopicReopened|null
 	*/
	public function getForumTopicReopened(): ?ForumTopicReopened
	{
		return $this->forumTopicReopened;
	}

	/**
 	* @return GeneralForumTopicHidden|null
 	*/
	public function getGeneralForumTopicHidden(): ?GeneralForumTopicHidden
	{
		return $this->generalForumTopicHidden;
	}

	/**
 	* @return GeneralForumTopicUnhidden|null
 	*/
	public function getGeneralForumTopicUnhidden(): ?GeneralForumTopicUnhidden
	{
		return $this->generalForumTopicUnhidden;
	}

	/**
 	* @return GiveawayCreated|null
 	*/
	public function getGiveawayCreated(): ?GiveawayCreated
	{
		return $this->giveawayCreated;
	}

	/**
 	* @return Giveaway|null
 	*/
	public function getGiveaway(): ?Giveaway
	{
		return $this->giveaway;
	}

	/**
 	* @return GiveawayWinners|null
 	*/
	public function getGiveawayWinners(): ?GiveawayWinners
	{
		return $this->giveawayWinners;
	}

	/**
 	* @return GiveawayCompleted|null
 	*/
	public function getGiveawayCompleted(): ?GiveawayCompleted
	{
		return $this->giveawayCompleted;
	}

	/**
 	* @return VideoChatScheduled|null
 	*/
	public function getVideoChatScheduled(): ?VideoChatScheduled
	{
		return $this->videoChatScheduled;
	}

	/**
 	* @return VideoChatStarted|null
 	*/
	public function getVideoChatStarted(): ?VideoChatStarted
	{
		return $this->videoChatStarted;
	}

	/**
 	* @return VideoChatEnded|null
 	*/
	public function getVideoChatEnded(): ?VideoChatEnded
	{
		return $this->videoChatEnded;
	}

	/**
 	* @return VideoChatParticipantsInvited|null
 	*/
	public function getVideoChatParticipantsInvited(): ?VideoChatParticipantsInvited
	{
		return $this->videoChatParticipantsInvited;
	}

	/**
 	* @return WebAppData|null
 	*/
	public function getWebAppData(): ?WebAppData
	{
		return $this->webAppData;
	}

	/**
 	* @return InlineKeyboardMarkup|null
 	*/
	public function getReplyMarkup(): ?InlineKeyboardMarkup
	{
		return $this->replyMarkup;
	}
}