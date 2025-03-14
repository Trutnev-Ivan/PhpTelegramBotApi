<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#story
 */
class Story implements \JsonSerializable
{
	protected Chat $chat;
	protected int $id;

	public function __construct(
		Chat $chat = null,
		int $id = 0
	)
	{
		$this->chat = $chat;
		$this->id = $id;
	}

	public static function fromArray(array $array): Story
	{
		return new static(
			$array["chat"] ? Chat::fromArray($array["chat"]) : null,
			$array["id"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"chat" => $this->chat ? $this->chat->jsonSerialize() : null,
			"id" => $this->id,
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
	public function getId(): int
	{
		return $this->id;
	}
}