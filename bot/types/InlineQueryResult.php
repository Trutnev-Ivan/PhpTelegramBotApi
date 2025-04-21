<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresult
 */
class InlineQueryResult
{
	public static function fromArray(array $array):
	InlineQueryResultCachedAudio
	| InlineQueryResultCachedDocument
	| InlineQueryResultCachedGif
	| InlineQueryResultCachedMpeg4Gif
	| InlineQueryResultCachedPhoto
	| InlineQueryResultCachedSticker
	| InlineQueryResultCachedVideo
	| InlineQueryResultCachedVoice
	| InlineQueryResultArticle
	| InlineQueryResultAudio
	| InlineQueryResultDocument
	| InlineQueryResultGif
	| InlineQueryResultMpeg4Gif
	| InlineQueryResultContact
	| InlineQueryResultGame
	| InlineQueryResultLocation
	| InlineQueryResultPhoto
	| InlineQueryResultVenue
	| InlineQueryResultVideo
	| InlineQueryResultVoice
	{
		switch ($array["type"]){
			case "audio":
				return isset($array["title"]) ? InlineQueryResultAudio::fromArray($array) : InlineQueryResultCachedAudio::fromArray($array);
            case "document":
				return isset($array["document_file_id"])? InlineQueryResultCachedDocument::fromArray($array) : InlineQueryResultDocument::fromArray($array);
			case "gif":
				return isset($array["gif_file_id"]) ? InlineQueryResultCachedGif::fromArray($array) : InlineQueryResultGif::fromArray($array);
			case "mpeg4_gif":
				return isset($array["mpeg4_file_id"]) ? InlineQueryResultCachedMpeg4Gif::fromArray($array) : InlineQueryResultMpeg4Gif::fromArray($array);
			case "photo":
				return isset($array["photo_file_id"]) ? InlineQueryResultCachedPhoto::fromArray($array) : InlineQueryResultPhoto::fromArray($array);
			case "sticker":
				return InlineQueryResultCachedSticker::fromArray($array);
			case "video":
				return isset($array["video_file_id"]) ? InlineQueryResultCachedVideo::fromArray($array) : InlineQueryResultVideo::fromArray($array);
			case "voice":
				return isset($array["voice_file_id"]) ? InlineQueryResultCachedVoice::fromArray($array) : InlineQueryResultVoice::fromArray($array);
			case "article":
				return InlineQueryResultArticle::fromArray($array);
			case "contact":
				return InlineQueryResultContact::fromArray($array);
			case "game":
				return InlineQueryResultGame::fromArray($array);
			case "location":
				return InlineQueryResultLocation::fromArray($array);
			case "venue":
				return InlineQueryResultVenue::fromArray($array);
		}

		throw new \InvalidArgumentException("Invalid type: ".$array["type"]);
	}
}