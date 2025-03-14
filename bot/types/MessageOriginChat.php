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
		string $type = "",
		int $date = 0,
		Chat $senderChat = null,
		string $authorSignature = null
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->senderChat = $senderChat;
		$this->authorSignature = $authorSignature;
	}

	public static function fromArray(array $array): MessageOriginChat
	{
		return new static(
			$array["type"] ?? "",
			$array["date"] ?? 0,
			$array["sender_chat"] ? Chat::fromArray($array["sender_chat"]) : null,
			$array["author_signature"] ?? null
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"date" => $this->date,
			"sender_chat" => $this->senderChat ? $this->senderChat->jsonSerialize() : null,
			"author_signature" => $this->authorSignature,
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