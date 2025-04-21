<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messagereactioncountupdated
 */
class MessageReactionCountUpdated implements \JsonSerializable
{
	protected Chat $chat;
	protected int $messageId;
	protected int $date;
	/**
	 * @var ReactionCount[]
	 */
	protected array $reactions;

	public function __construct(
		Chat $chat = null,
		int $messageId = 0,
		int $date = 0,
		array $reactions = []
	)
	{
		$this->chat = $chat;
		$this->messageId = $messageId;
		$this->date = $date;
		$this->reactions = $reactions;

		foreach ($this->reactions as $reaction) {
			if (!$reaction instanceof ReactionCount) {
				throw new \InvalidArgumentException('All reactions must be instances of ' . ReactionCount::class);
			}
		}
	}

	public static function fromArray(array $array): MessageReactionCountUpdated
	{
		return new static(
			Chat::fromArray($array["chat"] ?? []),
			$array["message_id"] ?? 0,
			$array["date"] ?? 0,
			$array["reactions"] ? array_map(fn($reaction) => ReactionCount::fromArray($reaction), $array["reactions"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"chat" => $this->chat->jsonSerialize(),
			"message_id" => $this->messageId,
			"date" => $this->date,
			"reactions" => $this->reactions ? array_map(fn($reaction) => $reaction->jsonSerialize(), $this->reactions) : [],
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
	 * @return int
	 */
	public function getMessageId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return ReactionCount[]
	 */
	public function getReactions(): array
	{
		return $this->reactions;
	}
}