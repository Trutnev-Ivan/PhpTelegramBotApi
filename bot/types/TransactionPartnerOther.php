<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartnerother
 */
class TransactionPartnerOther implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "other"
	)
	{
		$this->type = $type;

		if ($this->type != "other") {
			throw new \InvalidArgumentException("Invalid transaction partner type. Expected 'other', got '{$this->type}'.");
		}
	}

	public static function fromArray(array $array): TransactionPartnerOther
	{
		return new static($array["type"] ?? "other");
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}