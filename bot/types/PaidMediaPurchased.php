<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediapurchased
 */
class PaidMediaPurchased implements \JsonSerializable
{
	protected User $from;
	protected string $paidMediaPayload;

	public function __construct(
		User $from = null,
		string $paidMediaPayload = ""
	)
	{
		$this->from = $from;
		$this->paidMediaPayload = $paidMediaPayload;
	}

	public static function fromArray(array $array): PaidMediaPurchased
	{
		return new static(
			User::fromArray($array["from"]),
			$array["paid_media_payload"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"from" => $this->from->jsonSerialize(),
			"paid_media_payload" => $this->paidMediaPayload,
		];
	}

	/**
	 * @return User
	 */
	public function getFrom(): User
	{
		return $this->from;
	}

	/**
	 * @return string
	 */
	public function getPaidMediaPayload(): string
	{
		return $this->paidMediaPayload;
	}
}