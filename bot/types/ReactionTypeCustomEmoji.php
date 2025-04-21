<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontypecustomemoji
 */
class ReactionTypeCustomEmoji implements \JsonSerializable
{
	protected string $type;
	protected string $customEmojiId;

	public function __construct(
		string $type = "custom_emoji",
		string $customEmojiId = ""
	)
	{
		$this->type = $type;
		$this->customEmojiId = $customEmojiId;

		if ($this->type != "custom_emoji"){
			throw new \InvalidArgumentException("Invalid reaction type. Must be 'custom_emoji', got {$this->type}");
		}
	}

	public static function fromArray(array $array): ReactionTypeCustomEmoji
	{
		return new static(
			$array["type"] ?? "custom_emoji",
			$array["custom_emoji_id"] ?? ""
		);
	}

	public function jsonSerialize(): array
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