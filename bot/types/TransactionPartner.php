<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#transactionpartner
 */
class TransactionPartner
{
	public static function fromArray(array $array):
	TransactionPartnerUser
	| TransactionPartnerChat
	| TransactionPartnerAffiliateProgram
	| TransactionPartnerFragment
	| TransactionPartnerTelegramAds
	| TransactionPartnerTelegramApi
	| TransactionPartnerOther
	{
		switch ($array["type"]){
			case "user":
				return TransactionPartnerUser::fromArray($array);
            case "chat":
				return TransactionPartnerChat::fromArray($array);
			case "affiliate_program":
				return TransactionPartnerAffiliateProgram::fromArray($array);
			case "fragment":
				return TransactionPartnerFragment::fromArray($array);
			case "telegram_ads":
				TransactionPartnerTelegramAds::fromArray($array);
			case "telegram_api":
				TransactionPartnerTelegramApi::fromArray($array);
			case "other":
				return TransactionPartnerOther::fromArray($array);
		}

		throw new \InvalidArgumentException("Invalid type: ".$array["type"]);
	}
}