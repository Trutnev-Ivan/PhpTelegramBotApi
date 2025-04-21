<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#revenuewithdrawalstatefailed
 */
class RevenueWithdrawalStateFailed implements \JsonSerializable
{
	protected string $type;

	public function __construct(
		string $type = "failed"
	)
	{
		$this->type = $type;

		if ($this->type != "failed") {
			throw new \InvalidArgumentException("Invalid RevenueWithdrawalState type. Must be 'failed', got '{$this->type}'");
		}
	}

	public static function fromArray(array $array): RevenueWithdrawalStateFailed
	{
		return new static(
			$array["type"] ?? "failed"
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