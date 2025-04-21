<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#revenuewithdrawalstate
 */
class RevenueWithdrawalState
{
	public static function fromArray(array $array):
	RevenueWithdrawalStatePending
	|RevenueWithdrawalStateSucceeded
	|RevenueWithdrawalStateFailed
	{
		switch ($array["type"]) {
			case "pending":
				return RevenueWithdrawalStatePending::fromArray($array);
			case "succeeded":
				return RevenueWithdrawalStateSucceeded::fromArray($array);
			case "failed":
				return RevenueWithdrawalStateFailed::fromArray($array);
			default:
				throw new \InvalidArgumentException("Invalid RevenueWithdrawalState type: " . $array["type"]);
		}
	}
}