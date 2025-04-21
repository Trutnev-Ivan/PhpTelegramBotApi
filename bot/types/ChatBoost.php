<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatboost
 */
class ChatBoost implements \JsonSerializable
{
	protected string $boostId;
	protected int $addDate;
	protected int $expirationDate;
	protected ChatBoostSourcePremium
	| ChatBoostSourceGiftCode
	| ChatBoostSourceGiveaway $source;

	public function __construct(
		string $boostId = "",
		int $addDate = 0,
		int $expirationDate = 0,
		ChatBoostSourcePremium
		| ChatBoostSourceGiftCode
		| ChatBoostSourceGiveaway $source = null
	)
	{
		$this->boostId = $boostId;
		$this->addDate = $addDate;
		$this->expirationDate = $expirationDate;
		$this->source = $source;
	}

	public static function fromArray(array $array): ChatBoost
	{
		return new static(
			$array["boost_id"] ?? "",
			$array["add_date"] ?? 0,
			$array["expiration_date"] ?? 0,
			ChatBoostSource::fromArray($array["source"])
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"boost_id" => $this->boostId,
			"add_date" => $this->addDate,
			"expiration_date" => $this->expirationDate,
			"source" => $this->source->jsonSerialize(),
		];
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
	public function getAddDate(): int
	{
		return $this->addDate;
	}

	/**
	 * @return int
	 */
	public function getExpirationDate(): int
	{
		return $this->expirationDate;
	}

	/**
	 * @return ChatBoostSourcePremium
	 * | ChatBoostSourceGiftCode
	 * | ChatBoostSourceGiveaway
	 */
	public function getSource(): ChatBoostSourcePremium
	| ChatBoostSourceGiftCode
	| ChatBoostSourceGiveaway
	{
		return $this->source;
	}
}