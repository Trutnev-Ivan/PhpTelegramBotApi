<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#businessmessagesdeleted
 */
class BusinessMessagesDeleted implements \JsonSerializable
{
	protected string $businessConnectionId;
	protected Chat $chat;
	/**
	 * @var int[]
	 */
	protected array $messageIds;

	public function __construct(
		string $businessConnectionId = "",
		Chat $chat = null,
		array $messageIds = []
	)
	{
		$this->businessConnectionId = $businessConnectionId;
		$this->chat = $chat;
		$this->messageIds = $messageIds;

		foreach ($this->messageIds as $messageId) {
			if (!is_int($messageId)) {
				throw new \InvalidArgumentException("All messageIds must be integers");
			}
		}
	}

	public static function fromArray(array $array): BusinessMessagesDeleted
	{
		return new static(
			$array["business_connection_id"] ?? "",
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["message_ids"] ?? []
		);
	}

	public function jsonSerialize()
	{
		return [
			"business_connection_id" => $this->businessConnectionId,
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"message_ids" => $this->messageIds,
		];
	}

	/**
	 * @return string
	 */
	public function getBusinessConnectionId(): string
	{
		return $this->businessConnectionId;
	}

	/**
	 * @return Chat
	 */
	public function getChat(): Chat
	{
		return $this->chat;
	}

	/**
	 * @return array
	 */
	public function getMessageIds(): array
	{
		return $this->messageIds;
	}
}