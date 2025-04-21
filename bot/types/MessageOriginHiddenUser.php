<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageoriginhiddenuser
 */
class MessageOriginHiddenUser implements \JsonSerializable
{
	protected string $type;
	protected int $date;
	protected string $senderUserName;

	public function __construct(
		string $type = "hidden_user",
		int $date = 0,
		string $senderUserName = ""
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->senderUserName = $senderUserName;

		if ($this->type != "hidden_user"){
			throw new \InvalidArgumentException("Invalid type for MessageOriginHiddenUser. Must be 'hidden_user', gpt {$this->type}");
		}
	}

	public static function fromArray(array $array): MessageOriginHiddenUser
	{
		return new static(
			$array["type"] ?? "hidden_user",
			$array["date"] ?? 0,
			$array["sender_user_name"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"date" => $this->date,
			"sender_user_name" => $this->senderUserName,
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
	 * @return string
	 */
	public function getSenderUserName(): string
	{
		return $this->senderUserName;
	}
}