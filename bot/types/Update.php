<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#update
 */
class Update implements \JsonSerializable
{
	protected int $updateId;
	protected ?Message $message;
	protected ?Message $editedMessage;
	protected ?Message $channelPost;
	protected ?Message $editedChannelPost;
	protected ?BusinessConnection $businessConnection;
	protected ?Message $businessMessage;
	protected ?Message $editedBusinessMessage;
	protected ?BusinessMessagesDeleted $deletedBusinessMessages;
	protected ?MessageReactionUpdated $messageReaction;
	protected ?MessageReactionCountUpdated $messageReactionCount;
	protected ?InlineQuery $inlineQuery;
	protected ?ChosenInlineResult $chosenInlineResult;
	protected ?CallbackQuery $callbackQuery;
	protected ?ShippingQuery $shippingQuery;
	protected ?PreCheckoutQuery $preCheckoutQuery;
	protected ?PaidMediaPurchased $purchasedPaidMedia;
	protected ?Poll $poll;
	protected ?PollAnswer $pollAnswer;
	protected ?ChatMemberUpdated $myChatMember;
	protected ?ChatMemberUpdated $chatMember;
	protected ?ChatJoinRequest $chatJoinRequest;
	protected ?ChatBoostUpdated $chatBoost;
	protected ?ChatBoostRemoved $removedChatBoost;

	public function __construct(
		int $updateId = 0,
		?Message $message = null,
		?Message $editedMessage = null,
		?Message $channelPost = null,
		?Message $editedChannelPost = null,
		?BusinessConnection $businessConnection = null,
		?Message $businessMessage = null,
		?Message $editedBusinessMessage = null,
		?BusinessMessagesDeleted $deletedBusinessMessages = null,
		?MessageReactionUpdated $messageReaction = null,
		?MessageReactionCountUpdated $messageReactionCount = null,
		?InlineQuery $inlineQuery = null,
		?ChosenInlineResult $chosenInlineResult = null,
		?CallbackQuery $callbackQuery = null,
		?ShippingQuery $shippingQuery = null,
		?PreCheckoutQuery $preCheckoutQuery = null,
		?PaidMediaPurchased $purchasedPaidMedia = null,
		?Poll $poll = null,
		?PollAnswer $pollAnswer = null,
		?ChatMemberUpdated $myChatMember = null,
		?ChatMemberUpdated $chatMember = null,
		?ChatJoinRequest $chatJoinRequest = null,
	)
	{
		$this->updateId = $updateId;
		$this->message = $message;
		$this->editedMessage = $editedMessage;
		$this->channelPost = $channelPost;
		$this->editedChannelPost = $editedChannelPost;
		$this->businessConnection = $businessConnection;
		$this->businessMessage = $businessMessage;
		$this->editedBusinessMessage = $editedBusinessMessage;
		$this->deletedBusinessMessages = $deletedBusinessMessages;
		$this->messageReaction = $messageReaction;
		$this->messageReactionCount = $messageReactionCount;
		$this->inlineQuery = $inlineQuery;
		$this->chosenInlineResult = $chosenInlineResult;
		$this->callbackQuery = $callbackQuery;
		$this->shippingQuery = $shippingQuery;
		$this->preCheckoutQuery = $preCheckoutQuery;
		$this->purchasedPaidMedia = $purchasedPaidMedia;
		$this->poll = $poll;
		$this->pollAnswer = $pollAnswer;
		$this->myChatMember = $myChatMember;
		$this->chatMember = $chatMember;
		$this->chatJoinRequest = $chatJoinRequest;
	}

	public static function fromArray(array $array): Update
	{
		return new static(
			$array["update_id"] ?? 0,
			$array["message"] ? Message::fromArray($array["message"]) : null,
			$array["edited_message"] ? Message::fromArray($array["edited_message"]) : null,
			$array["channel_post"] ? Message::fromArray($array["channel_post"]) : null,
			$array["edited_channel_post"] ? Message::fromArray($array["edited_channel_post"]) : null,
			$array["business_connection"] ? BusinessConnection::fromArray($array["business_connection"]) : null,
			$array["business_message"] ? Message::fromArray($array["business_message"]) : null,
			$array["edited_business_message"] ? Message::fromArray($array["edited_business_message"]) : null,
			$array["deleted_business_messages"] ? BusinessMessagesDeleted::fromArray($array["deleted_business_messages"]) : null,
			$array["message_reaction"] ? MessageReactionUpdated::fromArray($array["message_reaction"]) : null,
			$array["message_reaction_count"] ? MessageReactionCountUpdated::fromArray($array["message_reaction_count"]) : null,
			$array["inline_query"] ? InlineQuery::fromArray($array["inline_query"]) : null,
			$array["chosen_inline_result"] ? ChosenInlineResult::fromArray($array["chosen_inline_result"]) : null,
			$array["callback_query"] ? CallbackQuery::fromArray($array["callback_query"]) : null,
			$array["shipping_query"] ? ShippingQuery::fromArray($array["shipping_query"]) : null,
			$array["pre_checkout_query"] ? PreCheckoutQuery::fromArray($array["pre_checkout_query"]) : null,
			$array["purchased_paid_media"] ? PaidMediaPurchased::fromArray($array["purchased_paid_media"]) : null,
			$array["poll"] ? Poll::fromArray($array["poll"]) : null,
			$array["poll_answer"] ? PollAnswer::fromArray($array["poll_answer"]) : null,
			$array["my_chat_member"] ? ChatMemberUpdated::fromArray($array["my_chat_member"]) : null,
			$array["chat_member"] ? ChatMemberUpdated::fromArray($array["chat_member"]) : null,
			$array["chat_join_request"] ? ChatJoinRequest::fromArray($array["chat_join_request"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"update_id" => $this->updateId,
		];

		if (isset($this->message)) {
			$array["message"] = $this->message->jsonSerialize();
		}
		if (isset($this->editedMessage)) {
			$array["edited_message"] = $this->editedMessage->jsonSerialize();
		}
		if (isset($this->channelPost)) {
			$array["channel_post"] = $this->channelPost->jsonSerialize();
		}
		if (isset($this->editedChannelPost)) {
			$array["edited_channel_post"] = $this->editedChannelPost->jsonSerialize();
		}
		if (isset($this->businessConnection)) {
			$array["business_connection"] = $this->businessConnection->jsonSerialize();
		}
		if (isset($this->businessMessage)) {
			$array["business_message"] = $this->businessMessage->jsonSerialize();
		}
		if (isset($this->editedBusinessMessage)) {
			$array["edited_business_message"] = $this->editedBusinessMessage->jsonSerialize();
		}
		if (isset($this->deletedBusinessMessages)) {
			$array["deleted_business_messages"] = $this->deletedBusinessMessages->jsonSerialize();
		}
		if (isset($this->messageReaction)) {
			$array["message_reaction"] = $this->messageReaction->jsonSerialize();
		}
		if (isset($this->messageReactionCount)) {
			$array["message_reaction_count"] = $this->messageReactionCount->jsonSerialize();
		}
		if (isset($this->inlineQuery)) {
			$array["inline_query"] = $this->inlineQuery->jsonSerialize();
		}
		if (isset($this->chosenInlineResult)) {
			$array["chosen_inline_result"] = $this->chosenInlineResult->jsonSerialize();
		}
		if (isset($this->callbackQuery)) {
			$array["callback_query"] = $this->callbackQuery->jsonSerialize();
		}
		if (isset($this->shippingQuery)) {
			$array["shipping_query"] = $this->shippingQuery->jsonSerialize();
		}
		if (isset($this->preCheckoutQuery)) {
			$array["pre_checkout_query"] = $this->preCheckoutQuery->jsonSerialize();
		}
		if (isset($this->purchasedPaidMedia)) {
			$array["purchased_paid_media"] = $this->purchasedPaidMedia->jsonSerialize();
		}
		if (isset($this->poll)) {
			$array["poll"] = $this->poll->jsonSerialize();
		}
		if (isset($this->pollAnswer)) {
			$array["poll_answer"] = $this->pollAnswer->jsonSerialize();
		}
		if (isset($this->myChatMember)) {
			$array["my_chat_member"] = $this->myChatMember->jsonSerialize();
		}
		if (isset($this->chatMember)) {
			$array["chat_member"] = $this->chatMember->jsonSerialize();
		}
		if (isset($this->chatJoinRequest)) {
			$array["chat_join_request"] = $this->chatJoinRequest->jsonSerialize();
		}
		if (isset($this->chatBoost)) {
			$array["chat_boost"] = $this->chatBoost->jsonSerialize();
		}
		if (isset($this->removedChatBoost)) {
			$array["removed_chat_boost"] = $this->removedChatBoost->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return int
	 */
	public function getUpdateId(): int
	{
		return $this->updateId;
	}

	/**
	 * @return Message|null
	 */
	public function getMessage(): ?Message
	{
		return $this->message;
	}

	/**
	 * @return Message|null
	 */
	public function getEditedMessage(): ?Message
	{
		return $this->editedMessage;
	}

	/**
	 * @return Message|null
	 */
	public function getChannelPost(): ?Message
	{
		return $this->channelPost;
	}

	/**
	 * @return Message|null
	 */
	public function getEditedChannelPost(): ?Message
	{
		return $this->editedChannelPost;
	}

	/**
	 * @return BusinessConnection|null
	 */
	public function getBusinessConnection(): ?BusinessConnection
	{
		return $this->businessConnection;
	}

	/**
	 * @return Message|null
	 */
	public function getBusinessMessage(): ?Message
	{
		return $this->businessMessage;
	}

	/**
	 * @return Message|null
	 */
	public function getEditedBusinessMessage(): ?Message
	{
		return $this->editedBusinessMessage;
	}

	/**
	 * @return BusinessMessagesDeleted|null
	 */
	public function getDeletedBusinessMessages(): ?BusinessMessagesDeleted
	{
		return $this->deletedBusinessMessages;
	}

	/**
	 * @return MessageReactionUpdated|null
	 */
	public function getMessageReaction(): ?MessageReactionUpdated
	{
		return $this->messageReaction;
	}

	/**
	 * @return MessageReactionCountUpdated|null
	 */
	public function getMessageReactionCount(): ?MessageReactionCountUpdated
	{
		return $this->messageReactionCount;
	}

	/**
	 * @return InlineQuery|null
	 */
	public function getInlineQuery(): ?InlineQuery
	{
		return $this->inlineQuery;
	}

	/**
	 * @return ChosenInlineResult|null
	 */
	public function getChosenInlineResult(): ?ChosenInlineResult
	{
		return $this->chosenInlineResult;
	}

	/**
	 * @return CallbackQuery|null
	 */
	public function getCallbackQuery(): ?CallbackQuery
	{
		return $this->callbackQuery;
	}

	/**
	 * @return ShippingQuery|null
	 */
	public function getShippingQuery(): ?ShippingQuery
	{
		return $this->shippingQuery;
	}

	/**
	 * @return PreCheckoutQuery|null
	 */
	public function getPreCheckoutQuery(): ?PreCheckoutQuery
	{
		return $this->preCheckoutQuery;
	}

	/**
	 * @return PaidMediaPurchased|null
	 */
	public function getPurchasedPaidMedia(): ?PaidMediaPurchased
	{
		return $this->purchasedPaidMedia;
	}

	/**
	 * @return Poll|null
	 */
	public function getPoll(): ?Poll
	{
		return $this->poll;
	}

	/**
	 * @return PollAnswer|null
	 */
	public function getPollAnswer(): ?PollAnswer
	{
		return $this->pollAnswer;
	}

	/**
	 * @return ChatMemberUpdated|null
	 */
	public function getMyChatMember(): ?ChatMemberUpdated
	{
		return $this->myChatMember;
	}

	/**
	 * @return ChatMemberUpdated|null
	 */
	public function getChatMember(): ?ChatMemberUpdated
	{
		return $this->chatMember;
	}

	/**
	 * @return ChatJoinRequest|null
	 */
	public function getChatJoinRequest(): ?ChatJoinRequest
	{
		return $this->chatJoinRequest;
	}

	/**
	 * @return ChatBoostUpdated|null
	 */
	public function getChatBoost(): ?ChatBoostUpdated
	{
		return $this->chatBoost;
	}

	/**
	 * @return ChatBoostRemoved|null
	 */
	public function getRemovedChatBoost(): ?ChatBoostRemoved
	{
		return $this->removedChatBoost;
	}
}
