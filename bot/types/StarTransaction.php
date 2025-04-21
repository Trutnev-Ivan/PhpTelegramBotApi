<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#startransaction
 */
class StarTransaction implements \JsonSerializable
{
	protected string $id;
	protected int $amount;
	protected ?int $nanostarAmount;
	protected int $date;
	protected TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null $source;
	protected TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null $receiver;

	public function __construct(
		string $id = "",
		int $amount = 0,
		?int $nanostarAmount = null,
		int $date = 0,
		TransactionPartnerUser
		| TransactionPartnerChat
		| TransactionPartnerAffiliateProgram
		| TransactionPartnerFragment
		| TransactionPartnerTelegramAds
		| TransactionPartnerTelegramApi
		| TransactionPartnerOther
		| null $source = null,
		TransactionPartnerUser
		| TransactionPartnerChat
		| TransactionPartnerAffiliateProgram
		| TransactionPartnerFragment
		| TransactionPartnerTelegramAds
		| TransactionPartnerTelegramApi
		| TransactionPartnerOther
		| null $receiver = null
	)
	{
		$this->id = $id;
		$this->amount = $amount;
		$this->nanostarAmount = $nanostarAmount;
		$this->date = $date;
		$this->source = $source;
		$this->receiver = $receiver;
	}

	public static function fromArray(array $array): StarTransaction
	{
		return new static(
			$array["id"] ?? "",
			$array["amount"] ?? 0,
			$array["nanostar_amount"],
			$array["date"] ?? 0,
			$array["source"] ? TransactionPartner::fromArray($array["source"]) : null,
			$array["receiver"] ? TransactionPartner::fromArray($array["receiver"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"amount" => $this->amount,
			"date" => $this->date,
		];

		if (isset($this->nanostarAmount)) {
			$array["nanostar_amount"] = $this->nanostarAmount;
		}
		if (isset($this->source)) {
			$array["source"] = $this->source->jsonSerialize();
		}
		if (isset($this->receiver)) {
			$array["receiver"] = $this->receiver->jsonSerialize();
		}

		return $array;
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
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @return int|null
	 */
	public function getNanostarAmount(): ?int
	{
		return $this->nanostarAmount;
	}

	/**
	 * @return int
	 */
	public function getDate(): int
	{
		return $this->date;
	}

	/**
	 * @return TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null
	 */
	public function getSource(): TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null
	{
		return $this->source;
	}

	/**
	 * @return TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null
	 */
	public function getReceiver(): TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	| null
	{
		return $this->receiver;
	}
}