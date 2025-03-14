<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatjoinrequest
 */
class ChatJoinRequest implements \JsonSerializable
{
	protected Chat $chat;
	protected User $from;
	protected int $userChatId;
	protected int $date;
	protected ?string $bio;
	protected ?ChatInviteLink $inviteLink;

	public function __construct(
		Chat $chat = null,
		User $from = null,
		int $userChatId = 0,
		int $date = 0,
		?string $bio = null,
		?ChatInviteLink $inviteLink = null
	)
	{
		$this->chat = $chat;
		$this->from = $from;
		$this->userChatId = $userChatId;
		$this->date = $date;
		$this->bio = $bio;
		$this->inviteLink = $inviteLink;
	}

	public static function fromArray(array $array): ChatJoinRequest
	{
		return new static(
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["user_chat_id"] ?? 0,
			$array["date"] ?? 0,
			$array["bio"],
			$array["invite_link"] ? ChatInviteLink::fromArray($array["invite_link"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"user_chat_id" => $this->userChatId,
			"date" => $this->date,
			"bio" => $this->bio,
			"invite_link" => $this->inviteLink ? $this->inviteLink->jsonSerialize() : null,
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
	public function getUserChatId(): int
	{
		return $this->userChatId;
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
	public function getBio(): ?string
	{
		return $this->bio;
	}

	/**
	 * @return ChatInviteLink|null
	 */
	public function getInviteLink(): ?ChatInviteLink
	{
		return $this->inviteLink;
	}
}