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
		string $type,
		int $date,
		string $senderUserName
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->senderUserName = $senderUserName;
	}

	public static function fromArray(array $array): MessageOriginHiddenUser
	{
		return new static(
			$array["type"] ?? "",
			$array["date"] ?? 0,
			$array["sender_user_name"] ?? ""
		);
	}

	public function jsonSerialize()
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