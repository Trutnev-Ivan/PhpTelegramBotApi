<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messagereactionupdated
 */
class MessageReactionUpdated implements \JsonSerializable
{
	protected Chat $chat;
	protected int $messageId;
	protected ?User $user;
	protected ?Chat $actorChat;
	protected int $date;
	/**
	 * @var ReactionType[]
	 */
	protected array $oldReaction;
	/**
	 * @var ReactionType[]
	 */
	protected array $newReaction;

	public function __construct(
		Chat $chat = null,
		int $messageId = 0,
		?User $user = null,
		?Chat $actorChat = null,
		int $date = 0,
		array $oldReaction = [],
		array $newReaction = []
	)
	{
		$this->chat = $chat;
		$this->messageId = $messageId;
		$this->user = $user;
		$this->actorChat = $actorChat;
		$this->date = $date;
		$this->oldReaction = $oldReaction;
		$this->newReaction = $newReaction;

		foreach ($this->oldReaction as $reaction) {
			if (!$reaction instanceof ReactionType) {
				throw new \InvalidArgumentException("All elements in 'oldReaction' must be instances of " . ReactionType::class);
			}
		}

		foreach ($this->newReaction as $reaction) {
			if (!$reaction instanceof ReactionType) {
				throw new \InvalidArgumentException("All elements in 'oldReaction' must be instances of " . ReactionType::class);
			}
		}
	}

	public static function fromArray(array $array): MessageReactionUpdated
	{
		return new static(
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["message_id"] ?? 0,
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["actor_chat"] ? Chat::fromArray($array["actor_chat"]) : null,
			$array["date"] ?? 0,
			$array["old_reaction"] ? array_map(fn($reaction) => ReactionType::fromArray($reaction), $array["old_reaction"]) : [],
			$array["new_reaction"] ? array_map(fn($reaction) => ReactionType::fromArray($reaction), $array["new_reaction"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"chat" => $this->chat->jsonSerialize(),
			"message_id" => $this->messageId,
			"date" => $this->date,
			"old_reaction" => $this->oldReaction ? array_map(fn($reaction) => $reaction->jsonSerialize(), $this->oldReaction) : [],
			"new_reaction" => $this->newReaction ? array_map(fn($reaction) => $reaction->jsonSerialize(), $this->newReaction) : [],
		];

		if (isset($this->user)){
			$array["user"] = $this->user->jsonSerialize();
		}
		if (isset($this->actorChat)){
			$array["actor_chat"] = $this->actorChat->jsonSerialize();
		}

		return $array;
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
	 * @return User|null
	 */
	public function getUser(): ?User
	{
		return $this->user;
	}

	/**
	 * @return Chat|null
	 */
	public function getActorChat(): ?Chat
	{
		return $this->actorChat;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return ReactionType[]
	 */
	public function getOldReaction(): array
	{
		return $this->oldReaction;
	}

	/**
	 * @return ReactionType[]
	 */
	public function getNewReaction(): array
	{
		return $this->newReaction;
	}
}