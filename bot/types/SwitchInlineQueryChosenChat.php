<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#switchinlinequerychosenchat
 */
class SwitchInlineQueryChosenChat implements \JsonSerializable
{
	protected ?string $query;
	protected bool $allowUserChats;
	protected bool $allowBotChats;
	protected bool $allowGroupChats;
	protected bool $allowChannelChats;

	public function __construct(
		?string $query = null,
		bool $allowUserChats = false,
		bool $allowBotChats = false,
		bool $allowGroupChats = false,
		bool $allowChannelChats = false
	)
	{
		$this->query = $query;
		$this->allowUserChats = $allowUserChats;
		$this->allowBotChats = $allowBotChats;
		$this->allowGroupChats = $allowGroupChats;
		$this->allowChannelChats = $allowChannelChats;
	}

	public static function fromArray(array $array): SwitchInlineQueryChosenChat
	{
		return new static(
			$array["query"],
			$array["allow_user_chats"] ?? false,
			$array["allow_bot_chats"] ?? false,
			$array["allow_group_chats"] ?? false,
			$array["allow_channel_chats"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"allow_user_chats" => $this->allowUserChats,
			"allow_bot_chats" => $this->allowBotChats,
			"allow_group_chats" => $this->allowGroupChats,
			"allow_channel_chats" => $this->allowChannelChats,
		];

		if (isset($this->query)){
			$array["query"] = $this->query;
		}

		return $array;
	}

	/**
	 * @return string|null
	 */
	public function getQuery(): ?string
	{
		return $this->query;
	}

	/**
	 * @return bool
	 */
	public function isAllowUserChats(): bool
	{
		return $this->allowUserChats;
	}

	/**
	 * @return bool
	 */
	public function isAllowBotChats(): bool
	{
		return $this->allowBotChats;
	}

	/**
	 * @return bool
	 */
	public function isAllowGroupChats(): bool
	{
		return $this->allowGroupChats;
	}

	/**
	 * @return bool
	 */
	public function isAllowChannelChats(): bool
	{
		return $this->allowChannelChats;
	}
}