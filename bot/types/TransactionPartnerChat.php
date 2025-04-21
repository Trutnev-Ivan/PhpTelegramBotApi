<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartnerchat
 */
class TransactionPartnerChat implements \JsonSerializable
{
	protected string $type;
	protected Chat $chat;
	protected ?Gift $gift;

	public function __construct(
		string $type = "chat",
		Chat $chat = null,
		?Gift $gift = null
	)
	{
		$this->type = $type;
		$this->chat = $chat;
		$this->gift = $gift;

		if ($this->type != "chat") {
			throw new \InvalidArgumentException("Invalid type for TransactionPartnerChat. Must be 'chat', got {$this->type}");
		}
	}

	public static function fromArray(array $array): TransactionPartnerChat
	{
		return new static(
			$array["type"] ?? "chat",
			isset($array["chat"]) ? Chat::fromArray($array["chat"]) : null,
			isset($array["gift"]) ? Gift::fromArray($array["gift"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"chat" => $this->chat,
		];

		if (isset($this->gift)) {
			$array["gift"] = $this->gift->jsonSerialize();
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
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return Gift|null
	 */
	public function getGift(): ?Gift
	{
		return $this->gift;
	}
}