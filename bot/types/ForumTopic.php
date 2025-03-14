<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forumtopic
 */
class ForumTopic implements \JsonSerializable
{
	protected int $messageThreadId;
	protected string $name;
	protected int $iconColor;
	protected string $iconCustomEmojiId;

	public function __construct(
		int $messageThreadId = 0,
		string $name = "",
		int $iconColor = 0,
		?string $iconCustomEmojiId = null
	)
	{
		$this->messageThreadId = $messageThreadId;
		$this->name = $name;
		$this->iconColor = $iconColor;
		$this->iconCustomEmojiId = $iconCustomEmojiId;
	}

	public static function fromArray(array $array): ForumTopic
	{
		return new static(
			$array["message_thread_id"] ?? 0,
			$array["name"] ?? "",
			$array["icon_color"] ?? 0,
			$array["icon_custom_emoji_id"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"message_thread_id" => $this->messageThreadId,
			"name" => $this->name,
			"icon_color" => $this->iconColor,
			"icon_custom_emoji_id" => $this->iconCustomEmojiId,
		];
	}

	/**
	 * @return int
	 */
	public function getMessageThreadId(): int
	{
		return $this->messageThreadId;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getIconColor(): int
	{
		return $this->iconColor;
	}

	/**
	 * @return string|null
	 */
	public function getIconCustomEmojiId(): ?string
	{
		return $this->iconCustomEmojiId;
	}
}