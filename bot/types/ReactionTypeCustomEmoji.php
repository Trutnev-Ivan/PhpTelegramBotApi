<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontypecustomemoji
 */
class ReactionTypeCustomEmoji implements \JsonSerializable
{
	protected string $type;
	protected string $customEmojiId;

	public function __construct(
		string $type = "",
		string $customEmojiId = ""
	)
	{
		$this->type = $type;
		$this->customEmojiId = $customEmojiId;
	}

	public static function fromArray(array $array): ReactionTypeCustomEmoji
	{
		return new static(
			$array["type"] ?? "",
			$array["custom_emoji_id"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"custom_emoji_id" => $this->customEmojiId,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getCustomEmojiId(): string
	{
		return $this->customEmojiId;
	}
}