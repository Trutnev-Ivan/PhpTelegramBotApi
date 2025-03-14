<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#invoice
 */
class Invoice implements \JsonSerializable
{
	protected string $title;
	protected string $description;
	protected string $startParameter;
	protected string $currency;
	protected int $totalAmount;

	public function __construct(
		string $title = "",
		string $description = "",
		string $startParameter = "",
		string $currency = "",
		int $totalAmount = 0
	)
	{
		$this->title = $title;
		$this->description = $description;
		$this->startParameter = $startParameter;
		$this->currency = $currency;
		$this->totalAmount = $totalAmount;
	}

	public static function fromArray(array $array): Invoice
	{
		return new static(
			$array["title"] ?? "",
			$array["description"] ?? "",
			$array["start_parameter"] ?? "",
			$array["currency"] ?? "",
			$array["total_amount"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"title" => $this->title,
			"description" => $this->description,
			"start_parameter" => $this->startParameter,
			"currency" => $this->currency,
			"total_amount" => $this->totalAmount,
		];
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getStartParameter(): string
	{
		return $this->startParameter;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->currency;
	}

	/**
	 * @return int
	 */
	public function getTotalAmount(): int
	{
		return $this->totalAmount;
	}
}