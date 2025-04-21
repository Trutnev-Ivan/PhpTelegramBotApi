<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forumtopicedited
 */
class ForumTopicEdited implements \JsonSerializable
{
	protected ?string $name;
	protected ?string $iconCustomEmojiId;

	public function __construct(
		?string $name = null,
		?string $iconCustomEmojiId = null
	)
	{
		$this->name = $name;
		$this->iconCustomEmojiId = $iconCustomEmojiId;
	}

	public static function fromArray(array $array): ForumTopicEdited
	{
		return new static(
			$array["name"] ?? null,
			$array["icon_custom_emoji_id"] ?? null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [];

		if (isset($this->name)){
			$array["name"] = $this->name;
		}
		if (isset($this->iconCustomEmojiId)){
			$array["icon_custom_emoji_id"] = $this->iconCustomEmojiId;
		}

		return $array;
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @return string|null
	 */
	public function getIconCustomEmojiId(): ?string
	{
		return $this->iconCustomEmojiId;
	}
}