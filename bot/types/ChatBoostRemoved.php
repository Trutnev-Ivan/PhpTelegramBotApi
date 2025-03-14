<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboostremoved
 */
class ChatBoostRemoved implements \JsonSerializable
{
	protected Chat $chat;
	protected string $boostId;
	protected int $removeDate;
	protected ChatBoostSource $source;

	public function __construct(
		Chat $chat = null,
		string $boostId = "",
		int $removeDate = 0,
		ChatBoostSource $source = null
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
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["boost_id"] ?? "",
			$array["remove_date"] ?? 0,
			$array["source"] ? ChatBoostSource::fromArray($array["source"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"boost_id" => $this->boostId,
			"remove_date" => $this->removeDate,
			"source" => $this->source ? $this->source->jsonSerialize() : null,
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
	 * @return ChatBoostSource
	 */
	public function getSource(): ChatBoostSource
	{
		return $this->source;
	}
}