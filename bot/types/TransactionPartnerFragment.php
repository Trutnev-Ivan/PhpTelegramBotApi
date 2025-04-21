<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartnerfragment
 */
class TransactionPartnerFragment implements \JsonSerializable
{
	protected string $type;
	protected RevenueWithdrawalStatePending
	|RevenueWithdrawalStateSucceeded
	|RevenueWithdrawalStateFailed
	|null $withdrawalState;

	public function __construct(
		string $type = "fragment",
		RevenueWithdrawalStatePending
		|RevenueWithdrawalStateSucceeded
		|RevenueWithdrawalStateFailed
		|null $withdrawalState = null
	)
	{
		$this->type = $type;
		$this->withdrawalState = $withdrawalState;

		if ($this->type != "fragment") {
			throw new \InvalidArgumentException("Invalid type for TransactionPartnerFragment. Must be 'fragment', got '{$this->type}'");
		}
	}

	public static function fromArray(array $array): TransactionPartnerFragment
	{
		return new static(
			$array["type"] ?? "fragment",
			isset($array["withdrawal_state"]) ? RevenueWithdrawalState::fromArray($array["withdrawal_state"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
		];

		if (isset($this->withdrawalState)) {
			$array["withdrawal_state"] = $this->withdrawalState->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return RevenueWithdrawalStatePending
	|RevenueWithdrawalStateSucceeded
	|RevenueWithdrawalStateFailed
	|null
	 */
	public function getWithdrawalState(): RevenueWithdrawalStatePending
	|RevenueWithdrawalStateSucceeded
	|RevenueWithdrawalStateFailed
	|null
	{
		return $this->withdrawalState;
	}
}