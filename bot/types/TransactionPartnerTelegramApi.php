<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartnertelegramapi
 */
class TransactionPartnerTelegramApi implements \JsonSerializable
{
	protected string $type;
	protected int $requestCount;

	public function __construct(
		string $type = "telegram_api",
		int $requestCount = 0
	)
	{
		$this->type = $type;
		$this->requestCount = $requestCount;

		if ($this->type != "telegram_api") {
			throw new \InvalidArgumentException("Invalid type for TransactionPartnerTelegramApi");
		}
	}

	public static function fromArray(array $array): TransactionPartnerTelegramApi
	{
		return new static(
			$array["type"] ?? "telegram_api",
			$array["request_count"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"request_count" => $this->requestCount,
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
	public function getRequestCount(): int
	{
		return $this->requestCount;
	}
}