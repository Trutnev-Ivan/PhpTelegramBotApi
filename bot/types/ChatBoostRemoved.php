<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostremoved
 */
class ChatBoostRemoved implements \JsonSerializable
{
	protected Chat $chat;
	protected string $boostId;
	protected int $removeDate;
	protected ChatBoostSourcePremium
	| ChatBoostSourceGiftCode
	| ChatBoostSourceGiveaway $source;

	public function __construct(
		Chat $chat = null,
		string $boostId = "",
		int $removeDate = 0,
		ChatBoostSourcePremium
		| ChatBoostSourceGiftCode
		| ChatBoostSourceGiveaway $source = null
	)
	{
		$this->chat = $chat;
		$this->boostId = $boostId;
		$this->removeDate = $removeDate;
		$this->source = $source;
	}

	public static function fromArray(array $array): ChatBoostRemoved
	{
		return new static(
			Chat::fromArray($array["chat"]),
			$array["boost_id"] ?? "",
			$array["remove_date"] ?? 0,
			ChatBoostSource::fromArray($array["source"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"chat" => $this->chat->jsonSerialize(),
			"boost_id" => $this->boostId,
			"remove_date" => $this->removeDate,
			"source" => $this->source->jsonSerialize(),
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
	 * @return string
	 */
	public function getBoostId(): string
	{
		return $this->boostId;
	}

	/**
	 * @return int
	 */
	public function getRemoveDate(): int
	{
		return $this->removeDate;
	}

	/**
	 * @return ChatBoostSourcePremium
	 * | ChatBoostSourceGiftCode
	 * | ChatBoostSourceGiveaway
	 */
	public function getSource(): ChatBoostSourcePremium
	| ChatBoostSourceGiftCode
	| ChatBoostSourceGiveaway
	{
		return $this->source;
	}
}