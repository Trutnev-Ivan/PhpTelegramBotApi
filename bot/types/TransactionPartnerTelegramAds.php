<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartnertelegramads
 */
class TransactionPartnerTelegramAds implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "telegram_ads"
	)
	{
		$this->type = $type;

		if ($this->type != "telegram_ads") {
			throw new \InvalidArgumentException("Invalid transaction partner type. Expected 'telegram_ads', got '{$this->type}'.");
		}
	}

	public static function fromArray(array $array): TransactionPartnerTelegramAds
	{
		return new static($array["type"] ?? "");
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