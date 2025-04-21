<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#preparedinlinemessage
 */
class PreparedInlineMessage implements \JsonSerializable
{
	protected string $id;
	protected int $expirationDate;

	public function __construct(
		string $id = "",
		int $expirationDate = 0,
	)
	{
		$this->id = $id;
		$this->expirationDate = $expirationDate;
	}

	public static function fromArray(array $array): PreparedInlineMessage
	{
		return new static(
			$array["id"] ?? "",
			$array["expiration_date"] ?? 0,
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"id" => $this->id,
			"expiration_date" => $this->expirationDate,
		];
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getExpirationDate(): int
	{
		return $this->expirationDate;
	}
}