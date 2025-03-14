<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontypeemoji
 */
class ReactionTypeEmoji implements \JsonSerializable
{
	protected string $type;
	protected string $emoji;

	public function __construct(
		string $type = "",
		string $emoji = ""
	)
	{
		$this->type = $type;
		$this->emoji = $emoji;
	}

	public static function fromArray(array $array): ReactionTypeEmoji
	{
		return new static(
			$array["type"] ?? "",
			$array["emoji"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"emoji" => $this->emoji,
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
	public function getEmoji(): string
	{
		return $this->emoji;
	}
}