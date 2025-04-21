<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#revenuewithdrawalstatesucceeded
 */
class RevenueWithdrawalStateSucceeded implements \JsonSerializable
{
	protected string $type;
	protected string $date;
	protected string $url;

	public function __construct(
		string $type = "succeeded",
		string $date = "",
		string $url = ""
	)
	{
		$this->type = $type;
		$this->date = $date;
		$this->url = $url;

		if ($this->type != "succeeded") {
			throw new \InvalidArgumentException("Invalid RevenueWithdrawalState type. Expected 'succeeded', got '{$this->type}'.");
		}
	}

	public static function fromArray(array $array): RevenueWithdrawalStateSucceeded
	{
		return new static(
			$array["type"] ?? "succeeded",
			$array["date"] ?? "",
			$array["url"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"date" => $this->date,
			"url" => $this->url,
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
	 * @return string
	 */
	public function getDate(): string
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}
}