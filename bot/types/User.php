<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#user
 */
class User implements \JsonSerializable
{
	protected int $id;
	protected bool $isBot;
	protected string $firstName;
	protected ?string $lastName;
	protected ?string $username;
	protected ?string $languageCode;
	protected bool $isPremium;
	protected bool $addedToAttachmentMenu;
	protected bool $canJoinGroups;
	protected bool $canReadAllGroupMessages;
	protected bool $supportsInlineQueries;
	protected bool $canConnectToBusiness;
	protected bool $hasMainWebApp;

	public function __construct(
		int $id = 0,
		bool $isBot = false,
		string $firstName = "",
		?string $lastName = null,
		?string $username = null,
		?string $languageCode = null,
		bool $isPremium = false,
		bool $addedToAttachmentMenu = false,
		bool $canJoinGroups = false,
		bool $canReadAllGroupMessages = false,
		bool $supportsInlineQueries = false,
		bool $canConnectToBusiness = false,
		bool $hasMainWebApp = false
	)
	{
		$this->id = $id;
		$this->isBot = $isBot;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->username = $username;
		$this->languageCode = $languageCode;
		$this->isPremium = $isPremium;
		$this->addedToAttachmentMenu = $addedToAttachmentMenu;
		$this->canJoinGroups = $canJoinGroups;
		$this->canReadAllGroupMessages = $canReadAllGroupMessages;
		$this->supportsInlineQueries = $supportsInlineQueries;
		$this->canConnectToBusiness = $canConnectToBusiness;
		$this->hasMainWebApp = $hasMainWebApp;
	}

	public static function fromArray(array $values): User
	{
		return new static(
			$values["id"] ?? 0,
			$values["is_bot"] ?? false,
			$values["first_name"] ?? "",
			$values["last_name"],
			$values["username"],
			$values["language_code"],
			$values["is_premium"] ?? false,
			$values["added_to_attachment_menu"] ?? false,
			$values["can_join_groups"] ?? false,
			$values["can_read_all_group_messages"] ?? false,
			$values["supports_inline_queries"] ?? false,
			$values["can_connect_to_business"] ?? false,
			$values["has_main_web_app"] ?? false
		);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function isBot(): bool
	{
		return $this->isBot;
	}

	public function getFirstName(): string
	{
		return $this->firstName;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function getUsername(): ?string
	{
		return $this->username;
	}

	public function getLanguageCode(): ?string
	{
		return $this->languageCode;
	}

	public function isPremium(): bool
	{
		return $this->isPremium;
	}

	public function isAddedToAttachmentMenu(): bool
	{
		return $this->addedToAttachmentMenu;
	}

	public function canJoinGroups(): bool
	{
		return $this->canJoinGroups;
	}

	public function canReadAllGroupMessages(): bool
	{
		return $this->canReadAllGroupMessages;
	}

	public function isSupportsInlineQueries(): bool
	{
		return $this->supportsInlineQueries;
	}

	public function canConnectToBusiness(): bool
	{
		return $this->canConnectToBusiness;
	}

	public function hasMainWebApp(): bool
	{
		return $this->hasMainWebApp;
	}

	public function jsonSerialize()
	{
		return [
			"id" => $this->id,
			"is_bot" => $this->isBot,
			"first_name" => $this->firstName,
			"last_name" => $this->lastName,
			"username" => $this->username,
			"language_code" => $this->languageCode,
			"is_premium" => $this->isPremium,
			"added_to_attachment_menu" => $this->addedToAttachmentMenu,
			"can_join_groups" => $this->canJoinGroups,
			"can_read_all_group_messages" => $this->canReadAllGroupMessages,
			"supports_inline_queries" => $this->supportsInlineQueries,
			"can_connect_to_business" => $this->canConnectToBusiness,
			"has_main_web_app" => $this->hasMainWebApp,
		];
	}
}
