<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageoriginchat
 */
class MessageOriginChat implements \JsonSerializable
{
	protected string $type;
	protected int $date;
	protected Chat $senderChat;
	protected ?string $authorSignature;

	public function __construct(
		string $type = "chat",
		int $date = 0,
		Chat $senderChat = null,
		string $authorSignature = null
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->senderChat = $senderChat;
		$this->authorSignature = $authorSignature;

		if ($this->type != "chat"){
			throw new \InvalidArgumentException("Type must be 'chat', got {$this->type}");
		}
	}

	public static function fromArray(array $array): MessageOriginChat
	{
		return new static(
			$array["type"] ?? "chat",
			$array["date"] ?? 0,
			Chat::fromArray($array["sender_chat"]),
			$array["author_signature"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"date" => $this->date,
			"sender_chat" => $this->senderChat->jsonSerialize(),
		];

		if (isset($this->authorSignature)) {
			$array["author_signature"] = $this->authorSignature;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return Chat
	 */
	public function getSenderChat(): Chat
	{
		return $this->senderChat;
	}

	/**
	 * @return string|null
	 */
	public function getAuthorSignature(): ?string
	{
		return $this->authorSignature;
	}
}