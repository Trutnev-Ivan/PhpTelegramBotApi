<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#startransactions
 */
class StarTransactions implements \JsonSerializable
{
	/**
	 * @var StarTransaction[]
	 */
	protected array $transactions;

	public function __construct(
		array $transactions = []
	)
	{
		$this->transactions = $transactions;

		foreach ($this->transactions as $transaction) {
			if (!$transaction instanceof StarTransaction) {
				throw new \InvalidArgumentException("All elements of 'transactions' must be instances of StarTransaction");
			}
		}
	}

	public static function fromArray(array $array): StarTransactions
	{
		return new static(
			$array["transactions"] ? array_map(fn($transaction) => StarTransaction::fromArray($transaction), $array["transactions"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"transactions" => array_map(fn($transaction) => $transaction->jsonSerialize(), $this->transactions),
		];
	}

	/**
	 * @return StarTransaction[]
	 */
	public function getTransactions(): array
	{
		return $this->transactions;
	}
}