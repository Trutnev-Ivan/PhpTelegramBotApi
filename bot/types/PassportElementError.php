<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerror
 */
class PassportElementError
{
	public static function fromArray(array $array):
	PassportElementErrorDataField
	| PassportElementErrorFrontSide
	| PassportElementErrorReverseSide
	| PassportElementErrorSelfie
	| PassportElementErrorFile
	| PassportElementErrorFiles
	| PassportElementErrorTranslationFile
	| PassportElementErrorTranslationFiles
	| PassportElementErrorUnspecified
	{
		switch ($array["source"]){
			case "data":
				return PassportElementErrorDataField::fromArray($array);
			case "front_side":
				return PassportElementErrorFrontSide::fromArray($array);
			case "reverse_side":
				return PassportElementErrorReverseSide::fromArray($array);
            case "selfie":
				return PassportElementErrorSelfie::fromArray($array);
			case "file":
				return PassportElementErrorFile::fromArray($array);
            case "files":
				return PassportElementErrorFiles::fromArray($array);
			case "translation_file":
				return PassportElementErrorTranslationFile::fromArray($array);
			case "translation_files":
				return PassportElementErrorTranslationFiles::fromArray($array);
			case "unspecified":
				return PassportElementErrorUnspecified::fromArray($array);
		}

		throw new \InvalidArgumentException("Invalid source: ".$array["source"]);
	}
}