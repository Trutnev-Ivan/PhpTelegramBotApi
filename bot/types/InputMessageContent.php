<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputmessagecontent
 */
class InputMessageContent
{
	public static function fromArray(array $array):
	InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	{
		if (isset($array["message_text"])){
			return InputTextMessageContent::fromArray($array);
		}
		elseif (
			isset($array["latitude"])
			&& isset($array["longitude"])
			&& isset($array["title"])
			&& isset($array["address"])
		){
			return InputVenueMessageContent::fromArray($array);
		}
		elseif (
			isset($array["latitude"]) && isset($array["longitude"])
		){
			return InputLocationMessageContent::fromArray($array);
		}
		elseif (
			isset($array["phone_number"]) && isset($array["first_name"])
		){
			return InputContactMessageContent::fromArray($array);
		}
		elseif (
			isset($array["title"])
            && isset($array["description"])
            && isset($array["payload"])
        )
		{
			return InputInvoiceMessageContent::fromArray($array);
		}

		throw new \InvalidArgumentException("Unsupported input message content type");
	}
}