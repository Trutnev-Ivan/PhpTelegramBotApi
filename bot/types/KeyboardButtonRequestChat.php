<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#keyboardbuttonrequestchat
 */
class KeyboardButtonRequestChat implements \JsonSerializable
{
	protected int $requestId;
	protected bool $chatIsChannel;
	protected bool $chatIsForum;
	protected bool $chatHasUsername;
	protected bool $chatIsCreated;
	protected ?ChatAdministratorRights $userAdministratorRights;
	protected ?ChatAdministratorRights $botAdministratorRights;
	protected bool $botIsMember;
	protected bool $requestTitle;
	protected bool $requestUsername;
	protected bool $requestPhoto;

	public function __construct(
		int $requestId = 0,
		bool $chatIsChannel = false,
		bool $chatIsForum = false,
		bool $chatHasUsername = false,
		bool $chatIsCreated = false,
		?ChatAdministratorRights $userAdministratorRights = null,
		?ChatAdministratorRights $botAdministratorRights = null,
		bool $botIsMember = false,
		bool $requestTitle = false,
		bool $requestUsername = false,
		bool $requestPhoto = false
	)
	{
		$this->requestId = $requestId;
		$this->chatIsChannel = $chatIsChannel;
		$this->chatIsForum = $chatIsForum;
		$this->chatHasUsername = $chatHasUsername;
		$this->chatIsCreated = $chatIsCreated;
		$this->userAdministratorRights = $userAdministratorRights;
		$this->botAdministratorRights = $botAdministratorRights;
		$this->botIsMember = $botIsMember;
		$this->requestTitle = $requestTitle;
		$this->requestUsername = $requestUsername;
		$this->requestPhoto = $requestPhoto;
	}

	public static function fromArray(array $array): KeyboardButtonRequestChat
	{
		return new static(
			$array["request_id"] ?? 0,
			$array["chat_is_channel"] ?? false,
			$array["chat_is_forum"] ?? false,
			$array["chat_has_username"] ?? false,
			$array["chat_is_created"] ?? false,
			$array["user_administrator_rights"] ? ChatAdministratorRights::fromArray($array["user_administrator_rights"]) : null,
			$array["bot_administrator_rights"] ? ChatAdministratorRights::fromArray($array["bot_administrator_rights"]) : null,
			$array["bot_is_member"] ?? false,
			$array["request_title"] ?? false,
			$array["request_username"] ?? false,
			$array["request_photo"] ?? false,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"request_id" => $this->requestId,
			"chat_is_channel" => $this->chatIsChannel,
			"chat_is_forum" => $this->chatIsForum,
			"chat_has_username" => $this->chatHasUsername,
			"chat_is_created" => $this->chatIsCreated,
			"bot_is_member" => $this->botIsMember,
			"request_title" => $this->requestTitle,
			"request_username" => $this->requestUsername,
			"request_photo" => $this->requestPhoto,
		];

		if (isset($this->userAdministratorRights)){
			$array["user_administrator_rights"] = $this->userAdministratorRights->jsonSerialize();
		}
		if (isset($this->botAdministratorRights)){
			$array["bot_administrator_rights"] = $this->botAdministratorRights->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return int
	 */
	public function getRequestId(): int
	{
		return $this->requestId;
	}

	/**
	 * @return bool
	 */
	public function isChatChannel(): bool
	{
		return $this->chatIsChannel;
	}

	/**
	 * @return bool
	 */
	public function isChatForum(): bool
	{
		return $this->chatIsForum;
	}

	/**
	 * @return bool
	 */
	public function hasChatUsername(): bool
	{
		return $this->chatHasUsername;
	}

	/**
	 * @return bool
	 */
	public function isChatCreated(): bool
	{
		return $this->chatIsCreated;
	}

	/**
	 * @return ChatAdministratorRights|null
	 */
	public function getUserAdministratorRights(): ?ChatAdministratorRights
	{
		return $this->userAdministratorRights;
	}

	/**
	 * @return ChatAdministratorRights|null
	 */
	public function getBotAdministratorRights(): ?ChatAdministratorRights
	{
		return $this->botAdministratorRights;
	}

	/**
	 * @return bool
	 */
	public function isBotMember(): bool
	{
		return $this->botIsMember;
	}

	/**
	 * @return bool
	 */
	public function isRequestTitle(): bool
	{
		return $this->requestTitle;
	}

	/**
	 * @return bool
	 */
	public function isRequestUsername(): bool
	{
		return $this->requestUsername;
	}

	/**
	 * @return bool
	 */
	public function isRequestPhoto(): bool
	{
		return $this->requestPhoto;
	}
}