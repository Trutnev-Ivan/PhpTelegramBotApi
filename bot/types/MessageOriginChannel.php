<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageoriginchannel
 */
class MessageOriginChannel implements \JsonSerializable
{
	protected string $type;
	protected int $date;
	protected Chat $chat;
	protected int $messageId;
	protected ?string $authorSignature;

	public function __construct(
		string $type = "channel",
		int $date = 0,
		Chat $chat = null,
		int $messageId = 0,
		?string $authorSignature = null
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->chat = $chat;
		$this->messageId = $messageId;
		$this->authorSignature = $authorSignature;

		if ($this->type != "channel"){
			throw new \InvalidArgumentException("Type must be 'channel', got {$this->type}");
		}
	}

	public static function fromArray(array $array): MessageOriginChannel
	{
		return new static(
			$array["type"] ?? "channel",
			$array["date"] ?? 0,
			Chat::fromArray($array["chat"]),
			$array["message_id"] ?? 0,
			$array["author_signature"] ?? null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"date" => $this->date,
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"message_id" => $this->messageId,
		];

		if (isset($this->authorSignature)){
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
	 * @return string|null
	 */
	public function getAuthorSignature(): ?string
	{
		return $this->authorSignature;
	}
}