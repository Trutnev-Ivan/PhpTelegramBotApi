<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#revenuewithdrawalstatepending
 */
class RevenueWithdrawalStatePending implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "pending"
	)
	{
		$this->type = $type;

		if ($this->type != "pending") {
			throw new \InvalidArgumentException("Invalid RevenueWithdrawalState type. Must be 'pending', got '{$this->type}'");
		}
	}

	public static function fromArray(array $array): RevenueWithdrawalStatePending
	{
		return new static(
			$array["type"] ?? "pending"
		);
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