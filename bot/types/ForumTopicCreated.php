<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forumtopiccreated
 */
class ForumTopicCreated implements \JsonSerializable
{
	protected string $name;
	protected int $iconColor;
	protected ?string $iconCustomEmojiId;

	public function __construct(
		string $name,
		int $iconColor,
		?string $iconCustomEmojiId = null
	)
	{
		$this->name = $name;
		$this->iconColor = $iconColor;
		$this->iconCustomEmojiId = $iconCustomEmojiId;
	}

	public static function fromArray(array $array): ForumTopicCreated
	{
		return new static(
			$array["name"] ?? "",
			$array["icon_color"] ?? 0,
			$array["icon_custom_emoji_id"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"name" => $this->name,
			"icon_color" => $this->iconColor,
		];

		if (isset($this->iconCustomEmojiId)){
			$array["icon_custom_emoji_id"] = $this->iconCustomEmojiId;
		}

		return $array;
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