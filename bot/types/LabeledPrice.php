<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#labeledprice
 */
class LabeledPrice implements \JsonSerializable
{
	protected string $label;
	protected int $amount;

	public function __construct(
		string $label,
		int $amount
	)
	{
		$this->label = $label;
		$this->amount = $amount;
	}

	public static function fromArray(array $array): LabeledPrice
	{
		return new static(
			$array["label"] ?? "",
			$array["amount"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"label" => $this->label,
			"amount" => $this->amount,
		];
	}

	/**
	 * @return string
	 */
	public function getLabel(): string
	{
		return $this->label;
	}

	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}
}