<?php namespace Telegram\Bot;

use InvalidArgumentException;
use Telegram\Bot\Types\BotCommand;
use Telegram\Bot\Types\BotCommandScopeAllChatAdministrators;
use Telegram\Bot\Types\BotCommandScopeAllGroupChats;
use Telegram\Bot\Types\BotCommandScopeAllPrivateChats;
use Telegram\Bot\Types\BotCommandScopeChat;
use Telegram\Bot\Types\BotCommandScopeChatAdministrators;
use Telegram\Bot\Types\BotCommandScopeChatMember;
use Telegram\Bot\Types\BotCommandScopeDefault;
use Telegram\Bot\Types\BotDescription;
use Telegram\Bot\Types\BotName;
use Telegram\Bot\Types\BotShortDescription;
use Telegram\Bot\Types\BusinessConnection;
use Telegram\Bot\Types\ChatAdministratorRights;
use Telegram\Bot\Types\ChatFullInfo;
use Telegram\Bot\Types\ChatInviteLink;
use Telegram\Bot\Types\ChatMember;
use Telegram\Bot\Types\ChatMemberAdministrator;
use Telegram\Bot\Types\ChatMemberBanned;
use Telegram\Bot\Types\ChatMemberLeft;
use Telegram\Bot\Types\ChatMemberMember;
use Telegram\Bot\Types\ChatMemberOwner;
use Telegram\Bot\Types\ChatMemberRestricted;
use Telegram\Bot\Types\ChatPermissions;
use Telegram\Bot\Types\File;
use Telegram\Bot\Types\ForceReply;
use Telegram\Bot\Types\ForumTopic;
use Telegram\Bot\Types\GameHighScore;
use Telegram\Bot\Types\Gifts;
use Telegram\Bot\Types\InlineKeyboardMarkup;
use Telegram\Bot\Types\InlineQueryResultArticle;
use Telegram\Bot\Types\InlineQueryResultAudio;
use Telegram\Bot\Types\InlineQueryResultCachedAudio;
use Telegram\Bot\Types\InlineQueryResultCachedDocument;
use Telegram\Bot\Types\InlineQueryResultCachedGif;
use Telegram\Bot\Types\InlineQueryResultCachedMpeg4Gif;
use Telegram\Bot\Types\InlineQueryResultCachedPhoto;
use Telegram\Bot\Types\InlineQueryResultCachedSticker;
use Telegram\Bot\Types\InlineQueryResultCachedVideo;
use Telegram\Bot\Types\InlineQueryResultCachedVoice;
use Telegram\Bot\Types\InlineQueryResultContact;
use Telegram\Bot\Types\InlineQueryResultDocument;
use Telegram\Bot\Types\InlineQueryResultGame;
use Telegram\Bot\Types\InlineQueryResultGif;
use Telegram\Bot\Types\InlineQueryResultLocation;
use Telegram\Bot\Types\InlineQueryResultMpeg4Gif;
use Telegram\Bot\Types\InlineQueryResultPhoto;
use Telegram\Bot\Types\InlineQueryResultsButton;
use Telegram\Bot\Types\InlineQueryResultVenue;
use Telegram\Bot\Types\InlineQueryResultVideo;
use Telegram\Bot\Types\InlineQueryResultVoice;
use Telegram\Bot\Types\InputFile;
use Telegram\Bot\Types\InputMediaAnimation;
use Telegram\Bot\Types\InputMediaAudio;
use Telegram\Bot\Types\InputMediaDocument;
use Telegram\Bot\Types\InputMediaPhoto;
use Telegram\Bot\Types\InputMediaVideo;
use Telegram\Bot\Types\InputPaidMediaPhoto;
use Telegram\Bot\Types\InputPaidMediaVideo;
use Telegram\Bot\Types\InputPollOption;
use Telegram\Bot\Types\InputSticker;
use Telegram\Bot\Types\LabeledPrice;
use Telegram\Bot\Types\LinkPreviewOptions;
use Telegram\Bot\Types\MaskPosition;
use Telegram\Bot\Types\MenuButton;
use Telegram\Bot\Types\MenuButtonCommands;
use Telegram\Bot\Types\MenuButtonDefault;
use Telegram\Bot\Types\MenuButtonWebApp;
use Telegram\Bot\Types\Message;
use Telegram\Bot\Types\MessageEntity;
use Telegram\Bot\Types\MessageId;
use Telegram\Bot\Types\Poll;
use Telegram\Bot\Types\PreparedInlineMessage;
use Telegram\Bot\Types\ReactionTypeCustomEmoji;
use Telegram\Bot\Types\ReactionTypeEmoji;
use Telegram\Bot\Types\ReactionTypePaid;
use Telegram\Bot\Types\ReplyKeyboardMarkup;
use Telegram\Bot\Types\ReplyKeyboardRemove;
use Telegram\Bot\Types\ReplyParameters;
use Telegram\Bot\Types\ShippingOption;
use Telegram\Bot\Types\StarTransactions;
use Telegram\Bot\Types\Sticker;
use Telegram\Bot\Types\StickerSet;
use Telegram\Bot\Types\Update;
use Telegram\Bot\Types\User;
use Telegram\Bot\Types\UserChatBoosts;
use Telegram\Bot\Types\SentWebAppMessage;
use Telegram\Bot\Types\UserProfilePhotos;
use Telegram\Bot\Types\WebhookInfo;
use Telegram\Bot\Utils\AdditionalParameters;
use Telegram\Exceptions\InvalidHttpStatusException;
use Telegram\Exceptions\InvalidResponseException;
use Telegram\Http\Exceptions\ConfigException;
use Telegram\Http\HttpClientFabric;
use Telegram\Http\Methods\Get;
use Telegram\Http\Methods\Post;
use Telegram\Http\Response;
use Telegram\Http\Methods\Base as HttpMethod;

abstract class Bot
{
	public function getToken(): string
	{
		return "";
	}

	/**
	 * @throws ConfigException
	 */
	public function query(string $method = "", HttpMethod $httpMethod = null, mixed $body = [], string ...$headers): Response
	{
		$httpClient = HttpClientFabric::getClient(
			"https://api.telegram.org/bot" . $this->getToken() . "/" . $method,
			$httpMethod ?? new Get
		);

		if ($headers) {
			foreach ($headers as $header) {
				$httpClient->addHeader($header);
			}
		} else {
			$httpClient->addHeader("Content-Type: application/json");
			$httpClient->addHeader("Accept: application/json");
		}

		if ($body) {
			$httpClient->setBody($body);
		}

		return $httpClient->query();
	}

	/**
	 * @see https://core.telegram.org/bots/api#getme
	 * @return User
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getMe(): User
	{
		$result = $this->query("getMe");
		$this->checkHttpStatus($result);

		$body = json_decode($result->getBody(), true);

		$this->checkJsonStatus($body);

		return User::fromArray($body["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#logout
	 * @return array
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function logOut(): array
	{
		$result = $this->query("logOut");
		$this->checkHttpStatus($result);

		$body = json_decode($result->getBody(), true);

		$this->checkJsonStatus($body);

		return $body;
	}

	/**
	 * @see https://core.telegram.org/bots/api#close
	 * @return array
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function close(): array
	{
		$result = $this->query("close");
		$this->checkHttpStatus($result);

		$body = json_decode($result->getBody(), true);

		$this->checkJsonStatus($body);

		return $body;
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendmessage
	 * @param int|string $chatId
	 * @param string $text
	 * @param array $params
	 * <code>
	 * [
	 *        "business_connection_id" => string,
	 *        "message_thread_id" => int,
	 *        "parse_mode" => string,
	 *        "entities" => MessageEntity[],
	 *        "link_preview_options" => LinkPreviewOptions,
	 *        "disable_notification" => bool,
	 *        "protect_content" => bool,
	 *        "allow_paid_broadcast" => bool,
	 *        "message_effect_id" => string,
	 *        "reply_parameters" => ReplyParameters,
	 *        "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidArgumentException
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function sendMessage(
		int|string $chatId,
		string $text,
		array $params = []
	)
	{
		$body = [
			"chat_id" => $chatId,
			"text" => $text,
		];

		$additionalParameters = new AdditionalParameters($params);

		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("parse_mode")
			->withArrayOfClass("entities", MessageEntity::class)
			->withClass("link_preview_options", LinkPreviewOptions::class)
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendMessage", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#forwardmessage
	 * @param int|string $chatId
	 * @param int|string $fromChatId
	 * @param int $messageId
	 * <code>
	 * [
	 *    "message_thread_id" => int,
	 *    "video_start_timestamp" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool
	 * ]
	 * </code>
	 * @param array $params
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function forwardMessage(
		int|string $chatId,
		int|string $fromChatId,
		int $messageId,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"from_chat_id" => $fromChatId,
			"message_id" => $messageId,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("message_thread_id")
			->withInt("video_start_timestamp")
			->withBool("disable_notification")
			->withBool("protect_content")
		;

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("forwardMessage", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#forwardmessages
	 * @param int|string $chatId
	 * @param int|string $fromChatId
	 * @param int[] $messageIds
	 * <code>
	 * [
	 *    "message_thread_id" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 * ]
	 * </code>
	 * @param array $params
	 * @return MessageId[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function forwardMessages(
		int|string $chatId,
		int|string $fromChatId,
		array $messageIds,
		array $params = []
	): array
	{
		foreach ($messageIds as $messageId) {
			if (!is_int($messageId)) {
				throw new InvalidArgumentException("Message IDs must be integers");
			}
		}

		$body = [
			"chat_id" => $chatId,
			"from_chat_id" => $fromChatId,
			"message_ids" => $messageIds,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("message_thread_id")
			->withBool("disable_notification")
			->withBool("protect_content")
		;

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("forwardMessages", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return array_map(fn($messageId) => MessageId::fromArray($messageId), $responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#copymessage
	 * @param int|string $chatId
	 * @param int|string $fromChatId
	 * @param int $messageId
	 * <code>
	 * [
	 *    "message_thread_id" => int,
	 *    "video_start_timestamp" => int,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @param array $params
	 * @return MessageId
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function copyMessage(
		int|string $chatId,
		int|string $fromChatId,
		int $messageId,
		array $params = []
	): MessageId
	{
		$body = [
			"chat_id" => $chatId,
			"from_chat_id" => $fromChatId,
			"message_id" => $messageId,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("message_thread_id")
			->withInt("video_start_timestamp")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("copyMessage", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return MessageId::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#copymessages
	 * @param int|string $chatId
	 * @param int|string $fromChatId
	 * @param int[] $messageIds
	 * <code>
	 * [
	 *    "message_thread_id" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "remove_caption" => bool,
	 * ]
	 * </code>
	 * @param array $params
	 * @return MessageId[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function copyMessages(
		int|string $chatId,
		int|string $fromChatId,
		array $messageIds,
		array $params = []
	): array
	{
		foreach ($messageIds as $messageId) {
			if (!is_int($messageId)) {
				throw new InvalidArgumentException("Message IDs must be integers");
			}
		}

		$body = [
			"chat_id" => $chatId,
			"from_chat_id" => $fromChatId,
			"message_ids" => $messageIds,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("message_thread_id")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("remove_caption")
		;

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("copyMessages", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return array_map(fn($messageId) => MessageId::fromArray($messageId), $responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendphoto
	 * @param int|string $chatId
	 * @param string|InputFile $photo http url, telegram file id or local file
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "has_spoiler" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendPhoto(
		int|string $chatId,
		string|InputFile $photo,
		array $params = []
	)
	{
		$body = [
			"chat_id" => $chatId,
			"photo" => $photo,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withBool("has_spoiler")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendPhoto"));
	}

	/**
	 * File must be in the .MP3 or .M4A format
	 *
	 * @see https://core.telegram.org/bots/api#sendaudio
	 * @param int|string $chatId
	 * @param string|InputFile $audio http url, telegram file id or local file
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "duration" => int,
	 *    "performer" => string,
	 *    "title" => string,
	 *    "thumbnail" => string|InputFile,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendAudio(
		int|string $chatId,
		string|InputFile $audio,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"audio" => $audio,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withInt("duration")
			->withString("performer")
			->withString("title")
			->withTypes("thumbnail", AdditionalParameters::STRING, InputFile::class)
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendAudio"));
	}

	/**
	 * @see https://core.telegram.org/bots/api#senddocument
	 * @param int|string $chatId
	 * @param string|InputFile $document http url, telegram file id or local file
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "thumbnail" => string | InputFile,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => "MessageEntity",
	 *    "disable_content_type_detection" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "message_effect_id" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply,
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendDocument(
		int|string $chatId,
		string|InputFile $document,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"document" => $document,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withTypes("thumbnail", AdditionalParameters::STRING, InputFile::class)
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("disable_content_type_detection")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;

		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendDocument"));
	}

	/**
	 * Must be MPEG4
	 *
	 * @see https://core.telegram.org/bots/api#sendvideo
	 * @param int|string $chatId
	 * @param string|InputFile $video http url, telegram file id or local file
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "duration" => int,
	 *    "width" => int,
	 *    "height" => int,
	 *    "thumbnail" => string|InputFile,
	 *    "cover" => string|InputFile,
	 *    "start_timestamp" => int,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "has_spoiler" => bool,
	 *    "supports_streaming" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendVideo(
		int|string $chatId,
		string|InputFile $video,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"video" => $video,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withInt("duration")
			->withInt("width")
			->withInt("height")
			->withTypes("thumbnail", AdditionalParameters::STRING, InputFile::class)
			->withTypes("cover", AdditionalParameters::STRING, InputFile::class)
			->withInt("start_timestamp")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withBool("has_spoiler")
			->withBool("supports_streaming")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;

		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendVideo"));
	}

	/**
	 * GIF or H.264/MPEG-4 AVC video without sound
	 *
	 * @see https://core.telegram.org/bots/api#sendanimation
	 *
	 * @param int|string $chatId
	 * @param string|InputFile $animation http url, telegram file id or local file
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "duration" => int,
	 *    "width" => int,
	 *    "height" => int,
	 *    "thumbnail" => string|InputFile,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "has_spoiler" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendAnimation(
		int|string $chatId,
		string|InputFile $animation,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"animation" => $animation,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withInt("duration")
			->withInt("width")
			->withInt("height")
			->withTypes("thumbnail", AdditionalParameters::STRING, InputFile::class)
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withBool("has_spoiler")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendAnimation"));
	}

	/**
	 * audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format
	 *
	 * @see https://core.telegram.org/bots/api#sendvoice
	 * @param int|string $chatId
	 * @param string|InputFile $voice
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "duration" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendVoice(
		int|string $chatId,
		string|InputFile $voice,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"voice" => $voice,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withInt("duration")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendVoice"));
	}

	/**
	 * As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long
	 *
	 * @see https://core.telegram.org/bots/api#sendvideonote
	 * @param int|string $chatId
	 * @param string|InputFile $videoNote
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "duration" => int,
	 *    "length" => int,
	 *    "thumbnail" => string|InputFile,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendVideoNote(
		int|string $chatId,
		string|InputFile $videoNote,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"video_note" => $videoNote,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withInt("duration")
			->withInt("length")
			->withTypes("thumbnail", AdditionalParameters::STRING, InputFile::class)
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendVideoNote"));
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendpaidmedia
	 * @param int|string $chatId
	 * @param int $starCount
	 * @param (InputPaidMediaPhoto|InputPaidMediaVideo)[] $media
	 * @param array $params
	 * <code>
	 *    "business_connection_id" => string,
	 *    "payload" => string,
	 *    "caption" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendPaidMedia(
		int|string $chatId,
		int $starCount,
		array $media,
		array $params = []
	): Message
	{
		if (!$media) {
			throw new InvalidArgumentException("At least one media must be provided");
		}

		$body = [
			"chat_id" => $chatId,
			"star_count" => $starCount,
			"media" => [],
		];

		foreach ($media as $mediaFile) {
			if (!$mediaFile instanceof InputPaidMediaPhoto
				&& !$mediaFile instanceof InputPaidMediaVideo) {
				throw new InvalidArgumentException("All media must be either InputPaidMediaPhoto or InputPaidMediaVideo");
			}

			$this->fillMediaToRequestBody($body, $mediaFile);
		}

		foreach ($body as $key => $value) {
			if ($value instanceof InputFile) {
				$body["media"] = json_encode($body["media"], true);
				break;
			}
		}

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withString("payload")
			->withString("caption")
			->withString("parse_mode")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return Message::fromArray($this->sendFilesByMethod($body, "sendPaidMedia"));
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendmediagroup
	 * @param int|string $chatId
	 * @param (InputMediaAudio | InputMediaDocument | InputMediaPhoto | InputMediaVideo)[] $media
	 * @param array $params must include 2-10 items
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters
	 * ]
	 * </code>
	 * @return Message[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendMediaGroup(
		int|string $chatId,
		array $media,
		array $params = []
	): array
	{
		if (!$media) {
			throw new InvalidArgumentException("At least one media must be provided");
		}

		$body = [
			"chat_id" => $chatId,
			"media" => [],
		];

		foreach ($media as $mediaFile) {
			if (!$mediaFile instanceof InputMediaAudio
				&& !$mediaFile instanceof InputMediaDocument
				&& !$mediaFile instanceof InputMediaPhoto
				&& !$mediaFile instanceof InputMediaVideo
			) {
				throw new InvalidArgumentException("All media must be either InputPaidMediaPhoto or InputPaidMediaVideo or InputMediaPhoto or InputMediaVideo");
			}

			$this->fillMediaToRequestBody($body, $mediaFile);
		}

		foreach ($body as $key => $value) {
			if ($value instanceof InputFile) {
				$body["media"] = json_encode($body["media"], true);
				break;
			}
		}

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
		;

		$body = array_merge($body, $additionalParameters->getParameters());

		return array_map(fn($message) => Message::fromArray($message), $this->sendFilesByMethod($body, "sendMediaGroup"));
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendlocation
	 * @param int|string $chatId
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "horizontal_accuracy" => float,
	 *    "live_period" => int,
	 *    "heading" => int,
	 *    "proximity_alert_radius" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidResponseException
	 * @throws InvalidHttpStatusException
	 */
	public function sendLocation(
		int|string $chatId,
		float $latitude,
		float $longitude,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"latitude" => $latitude,
			"longitude" => $longitude,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withFloat("horizontal_accuracy")
			->withInt("live_period")
			->withInt("heading")
			->withInt("proximity_alert_radius")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendLocation", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendvenue
	 * @param int|string $chatId
	 * @param float $latitude
	 * @param float $longitude
	 * @param string $title
	 * @param string $address
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "foursquare_id" => string,
	 *    "foursquare_type" => string,
	 *    "google_place_id" => string,
	 *    "google_place_type" => string,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendVenue(
		int|string $chatId,
		float $latitude,
		float $longitude,
		string $title,
		string $address,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"title" => $title,
			"address" => $address,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("foursquare_id")
			->withString("foursquare_type")
			->withString("google_place_id")
			->withString("google_place_type")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendVenue", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendcontact
	 * @param int|string $chatId
	 * @param string $phoneNumber
	 * @param string $firstName
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "last_name" => string,
	 *    "vcard" => string,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" =>    InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendContact(
		int|string $chatId,
		string $phoneNumber,
		string $firstName,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"phone_number" => $phoneNumber,
			"first_name" => $firstName,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("last_name")
			->withString("vcard")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendContact", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendpoll
	 * @param int|string $chatId
	 * @param string $question
	 * @param InputPollOption[] $options
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "question_parse_mode" => string,
	 *    "question_entities" => MessageEntity[],
	 *    "is_anonymous" => bool,
	 *    "type" => string,
	 *    "allows_multiple_answers" => bool,
	 *    "correct_option_id" => int,
	 *    "explanation" => string,
	 *    "explanation_parse_mode" => string,
	 *    "explanation_entities" => MessageEntity[],
	 *    "open_period" => int,
	 *    "close_date" => int,
	 *    "is_closed" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendPoll(
		int|string $chatId,
		string $question,
		array $options,
		array $params = []
	): Message
	{
		if (!$options) {
			throw new InvalidArgumentException("Options array cannot be empty.");
		}

		foreach ($options as $option) {
			if (!$option instanceof InputPollOption) {
				throw new InvalidArgumentException("All options must be instances of " . InputPollOption::class);
			}
		}

		$body = [
			"chat_id" => $chatId,
			"question" => $question,
			"options" => $options,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("question_parse_mode")
			->withArrayOfClass("question_entities", MessageEntity::class)
			->withBool("is_anonymous")
			->withString("type")
			->withBool("allows_multiple_answers")
			->withInt("correct_option_id")
			->withString("explanation")
			->withString("explanation_parse_mode")
			->withArrayOfClass("explanation_entities", MessageEntity::class)
			->withInt("open_period")
			->withInt("close_date")
			->withBool("is_closed")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendPoll", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#senddice
	 * @param int|string $chatId
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "emoji" => string,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" =>    InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendDice(
		int|string $chatId,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("emoji")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendDice", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendchataction
	 * @param int|string $chatId
	 * @param string $action
	 * "typing" | "upload_photo" | "record_video" | "upload_video" | "record_voice" | "upload_voice"
	 * | "upload_document" | "choose_sticker" | "find_location" | "record_video_note" | "upload_video_note"
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidResponseException
	 * @throws InvalidHttpStatusException
	 */
	public function sendChatAction(
		int|string $chatId,
		string $action,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"action" => $action,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendChatAction", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmessagereaction
	 * @param int|string $chatId
	 * @param int $messageId
	 * @param array $params
	 * <code>
	 * [
	 *    "reaction" => (ReactionTypeEmoji|ReactionTypeCustomEmoji|ReactionTypePaid)[],
	 *    "is_big" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setMessageReaction(
		int|string $chatId,
		int $messageId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_id" => $messageId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withArrayOfClasses(
				"reaction",
				ReactionTypeEmoji::class,
				ReactionTypeCustomEmoji::class,
				ReactionTypePaid::class
			)
			->withBool("is_big")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setMessageReaction", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getuserprofilephotos
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "offset" => int,
	 *    "limit" => int
	 * ]
	 * </code>
	 * @return UserProfilePhotos
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getUserProfilePhotos(
		int $userId,
		array $params = []
	): UserProfilePhotos
	{
		$body = [
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("offset")
			->withInt("limit")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("getUserProfilePhotos", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return UserProfilePhotos::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setuseremojistatus
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "emoji_status_custom_emoji_id" => string,
	 *    "emoji_status_expiration_date" => int
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setUserEmojiStatus(
		int $userId,
		array $params = []
	): bool
	{
		$body = [
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("emoji_status_custom_emoji_id")
			->withInt("emoji_status_expiration_date")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setUserEmojiStatus", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getfile
	 * @param string $fileId
	 * @return File
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getFile(
		string $fileId
	): File
	{
		$body = [
			"file_id" => $fileId,
		];
		$result = $this->query("getFile", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return File::fromArray($responseBody["result"]);
	}

	public function downloadFile(
		string $fileId,
		string $saveFilePath
	)
	{
		$file = $this->getFile($fileId);

		$httpClient = HttpClientFabric::getClient(
			"https://api.telegram.org/file/bot" . $this->getToken() . "/" . $file->getFilePath(),
			new Get
		);

		$httpClient->addHeader("Content-Type: application/json");
		$httpClient->addHeader("Accept: application/json");

		$fileContent = $httpClient->query()->getBody();

		preg_replace("/\..*$/", "", $saveFilePath);
		$saveFilePath .= "." . pathinfo($file->getFilePath(), PATHINFO_EXTENSION);
		file_put_contents($saveFilePath, $fileContent);

		return true;
	}

	/**
	 * @see https://core.telegram.org/bots/api#banchatmember
	 * @param int|string $chatId
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "until_date" => int,
	 *    "revoke_messages" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function banChatMember(
		int|string $chatId,
		int $userId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("until_date")
			->withBool("revoke_messages")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("banChatMember", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unbanchatmember
	 * @param int|string $chatId
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "only_if_banned" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function unbanChatMember(
		int|string $chatId,
		int $userId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("only_if_banned")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("unbanChatMember", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#restrictchatmember
	 * @param int|string $chatId
	 * @param int $userId
	 * @param ChatPermissions $permissions
	 * @param array $params
	 * <code>
	 * [
	 *    "use_independent_chat_permissions" => bool,
	 *    "until_date" => int
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function restrictChatMember(
		int|string $chatId,
		int $userId,
		ChatPermissions $permissions,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
			"permissions" => $permissions,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("use_independent_chat_permissions")
			->withInt("until_date")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("restrictChatMember", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#promotechatmember
	 * @param int|string $chatId
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "is_anonymous" => bool,
	 *    "can_manage_chat" => bool,
	 *    "can_delete_messages" => bool,
	 *    "can_manage_video_chats" => bool,
	 *    "can_restrict_members" => bool,
	 *    "can_promote_members" => bool,
	 *    "can_change_info" => bool,
	 *    "can_invite_users" => bool,
	 *    "can_post_stories" => bool,
	 *    "can_edit_stories" => bool,
	 *    "can_delete_stories" => bool,
	 *    "can_post_messages" => bool,
	 *    "can_edit_messages" => bool,
	 *    "can_pin_messages" => bool,
	 *    "can_manage_topics" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function promoteChatMember(
		int|string $chatId,
		int $userId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("is_anonymous")
			->withBool("can_manage_chat")
			->withBool("can_delete_messages")
			->withBool("can_manage_video_chats")
			->withBool("can_restrict_members")
			->withBool("can_promote_members")
			->withBool("can_change_info")
			->withBool("can_invite_users")
			->withBool("can_post_stories")
			->withBool("can_edit_stories")
			->withBool("can_delete_stories")
			->withBool("can_post_messages")
			->withBool("can_edit_messages")
			->withBool("can_pin_messages")
			->withBool("can_manage_topics")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("promoteChatMember", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatadministratorcustomtitle
	 * @param int|string $chatId
	 * @param int $userId
	 * @param string $customTitle
	 * @return bool
	 * @throws InvalidResponseException
	 * @throws InvalidHttpStatusException
	 */
	public function setChatAdministratorCustomTitle(
		int|string $chatId,
		int $userId,
		string $customTitle
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
			"custom_title" => $customTitle,
		];
		$result = $this->query("setChatAdministratorCustomTitle", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#banchatsenderchat
	 * @param int|string $chatId
	 * @param int $senderChatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function banChatSenderChat(
		int|string $chatId,
		int $senderChatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"sender_chat_id" => $senderChatId,
		];
		$result = $this->query("banChatSenderChat", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unbanchatsenderchat
	 * @param int|string $chatId
	 * @param int $senderChatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function unbanChatSenderChat(
		int|string $chatId,
		int $senderChatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"sender_chat_id" => $senderChatId,
		];
		$result = $this->query("unbanChatSenderChat", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatpermissions
	 * @param int|string $chatId
	 * @param ChatPermissions $permissions
	 * @param array $params
	 * <code>
	 * [
	 *    "use_independent_chat_permissions" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setChatPermissions(
		int|string $chatId,
		ChatPermissions $permissions,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"permissions" => $permissions,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("use_independent_chat_permissions")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setChatPermissions", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#exportchatinvitelink
	 * @param int|string $chatId
	 * @return string
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function exportChatInviteLink(
		int|string $chatId
	): string
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("exportChatInviteLink", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#createchatinvitelink
	 * @param int|string $chatId
	 * @param array $params
	 * <code>
	 * [
	 *    "name" => string,
	 *    "expire_date" => int,
	 *    "member_limit" => int,
	 *    "creates_join_request" => bool
	 * ]
	 * </code>
	 * @return ChatInviteLink
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function createChatInviteLink(
		int|string $chatId,
		array $params = []
	): ChatInviteLink
	{
		$body = [
			"chat_id" => $chatId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
			->withInt("expire_date")
			->withInt("member_limit")
			->withBool("creates_join_request")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("createChatInviteLink", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatInviteLink::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editchatinvitelink
	 * @param int|string $chatId
	 * @param string $inviteLink
	 * @param array $params
	 * <code>
	 * [
	 *    "name" => string,
	 *    "expire_date" => int,
	 *    "member_limit" => int,
	 *    "creates_join_request" => bool
	 * ]
	 * </code>
	 * @return ChatInviteLink
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function editChatInviteLink(
		int|string $chatId,
		string $inviteLink,
		array $params = []
	): ChatInviteLink
	{
		$body = [
			"chat_id" => $chatId,
			"invite_link" => $inviteLink,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
			->withInt("expire_date")
			->withInt("member_limit")
			->withBool("creates_join_request")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editChatInviteLink", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatInviteLink::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
	 * @param int|string $chatId
	 * @param int $subscriptionPeriod
	 * @param int $subscriptionPrice
	 * @param array $params
	 * <code>
	 * [
	 * "name" => string
	 * ]
	 * </code>
	 * @return ChatInviteLink
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function createChatSubscriptionInviteLink(
		int|string $chatId,
		int $subscriptionPeriod,
		int $subscriptionPrice,
		array $params = []
	): ChatInviteLink
	{
		$body = [
			"chat_id" => $chatId,
			"subscription_period" => $subscriptionPeriod,
			"subscription_price" => $subscriptionPrice,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("createChatSubscriptionInviteLink", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatInviteLink::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
	 * @param int|string $chatId
	 * @param string $inviteLink
	 * @param array $params
	 * <code>
	 * [
	 *    "name" => string
	 * ]
	 * </code>
	 * @return ChatInviteLink
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function editChatSubscriptionInviteLink(
		int|string $chatId,
		string $inviteLink,
		array $params = []
	): ChatInviteLink
	{
		$body = [
			"chat_id" => $chatId,
			"invite_link" => $inviteLink,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editChatSubscriptionInviteLink", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatInviteLink::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#revokechatinvitelink
	 * @param int|string $chatId
	 * @param string $inviteLink
	 * @return ChatInviteLink
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function revokeChatInviteLink(
		int|string $chatId,
		string $inviteLink
	): ChatInviteLink
	{
		$body = [
			"chat_id" => $chatId,
			"invite_link" => $inviteLink,
		];
		$result = $this->query("revokeChatInviteLink", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatInviteLink::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#approvechatjoinrequest
	 * @param int|string $chatId
	 * @param int $userId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function approveChatJoinRequest(
		int|string $chatId,
		int $userId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$result = $this->query("approveChatJoinRequest", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#declinechatjoinrequest
	 * @param int|string $chatId
	 * @param int $userId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function declineChatJoinRequest(
		int|string $chatId,
		int $userId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$result = $this->query("declineChatJoinRequest", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatphoto
	 * @param int|string $chatId
	 * @param InputFile $photo
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setChatPhoto(
		int|string $chatId,
		InputFile $photo
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"photo" => $photo,
		];
		$result = $this->query("setChatPhoto", new Post, $body, "Content-Type: multipart/form-data");
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletechatphoto
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function deleteChatPhoto(int|string $chatId): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("deleteChatPhoto", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchattitle
	 * @param int|string $chatId
	 * @param string $title
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setChatTitle(
		int|string $chatId,
		string $title
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"title" => $title,
		];
		$result = $this->query("setChatTitle", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatdescription
	 * @param int|string $chatId
	 * @param string $description
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setChatDescription(
		int|string $chatId,
		string $description
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"description" => $description,
		];
		$result = $this->query("setChatDescription", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#pinchatmessage
	 * @param int|string $chatId
	 * @param int $messageId
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id	" => string,
	 *    "disable_notification" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function pinChatMessage(
		int|string $chatId,
		int $messageId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_id" => $messageId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withBool("disable_notification")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("pinChatMessage", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unpinchatmessage
	 * @param int|string $chatId
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_id" => int
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function unpinChatMessage(
		int|string $chatId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("unpinChatMessage", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unpinallchatmessages
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function unpinAllChatMessages(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("unpinAllChatMessages", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#leavechat
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function leaveChat(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("leaveChat", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getchat
	 * @param int|string $chatId
	 * @return ChatFullInfo
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getChat(
		int|string $chatId
	): ChatFullInfo
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("getChat", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatFullInfo::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getchatadministrators
	 * @param int|string $chatId
	 * @return ChatMember[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getChatAdministrators(
		int|string $chatId
	): array
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("getChatAdministrators", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		$chatMembers = [];

		foreach ($responseBody["result"] as $chatMember) {
			$chatMembers[] = ChatMember::fromArray($chatMember);
		}

		return $chatMembers;
	}

	/**
	 * @see https://core.telegram.org/bots/api#getchatmember
	 * @param int|string $chatId
	 * @param int $userId
	 * @return ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getChatMember(
		int|string $chatId,
		int $userId
	): ChatMemberOwner|ChatMemberAdministrator|ChatMemberMember|ChatMemberRestricted|ChatMemberLeft|ChatMemberBanned
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];
		$result = $this->query("getChatMember", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatMember::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatstickerset
	 * @param int|string $chatId
	 * @param string $stickerSetName
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setChatStickerSet(
		int|string $chatId,
		string $stickerSetName
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"sticker_set_name" => $stickerSetName,
		];
		$result = $this->query("setChatStickerSet", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletechatstickerset
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function deleteChatStickerSet(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("deleteChatStickerSet", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getforumtopiciconstickers
	 * @return Sticker[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getForumTopicIconStickers(): array
	{
		$result = $this->query("getForumTopicIconStickers");
		$this->checkHttpStatus($result);

		$body = json_decode($result->getBody(), true);

		$this->checkJsonStatus($body);

		$stickers = [];

		foreach ($body["result"] as $sticker) {
			$stickers[] = Sticker::fromArray($sticker);
		}

		return $stickers;
	}

	/**
	 * @see https://core.telegram.org/bots/api#createforumtopic
	 * @param int|string $chatId
	 * @param string $name
	 * @param array $params
	 * <code>
	 * [
	 *    "icon_color" => int,
	 *    "icon_custom_emoji_id" => string
	 * ]
	 * </code>
	 * @return ForumTopic
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function createForumTopic(
		int|string $chatId,
		string $name,
		array $params = []
	): ForumTopic
	{
		$body = [
			"chat_id" => $chatId,
			"name" => $name,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("icon_color")
			->withString("icon_custom_emoji_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("createForumTopic", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ForumTopic::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editforumtopic
	 * @param int|string $chatId
	 * @param int $messageThreadId
	 * @param array $params
	 * <code>
	 * [
	 *    "name" => string,
	 *    "icon_custom_emoji_id" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function editForumTopic(
		int|string $chatId,
		int $messageThreadId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_thread_id" => $messageThreadId,
		];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
			->withString("icon_custom_emoji_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("editForumTopic", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#closeforumtopic
	 * @param int|string $chatId
	 * @param int $messageThreadId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function closeForumTopic(
		int|string $chatId,
		int $messageThreadId,
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_thread_id" => $messageThreadId,
		];

		$result = $this->query("closeForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#reopenforumtopic
	 * @param int|string $chatId
	 * @param int $messageThreadId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function reopenForumTopic(
		int|string $chatId,
		int $messageThreadId,
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_thread_id" => $messageThreadId,
		];

		$result = $this->query("reopenForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#deleteforumtopic
	 * @param int|string $chatId
	 * @param int $messageThreadId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function deleteForumTopic(
		int|string $chatId,
		int $messageThreadId,
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_thread_id" => $messageThreadId,
		];

		$result = $this->query("deleteForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unpinallforumtopicmessages
	 * @param int|string $chatId
	 * @param int $messageThreadId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function unpinAllForumTopicMessages(
		int|string $chatId,
		int $messageThreadId,
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_thread_id" => $messageThreadId,
		];

		$result = $this->query("unpinAllForumTopicMessages", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#editgeneralforumtopic
	 * @param int|string $chatId
	 * @param string $name
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function editGeneralForumTopic(
		int|string $chatId,
		string $name
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"name" => $name,
		];

		$result = $this->query("editGeneralForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#closegeneralforumtopic
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function closeGeneralForumTopic(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];

		$result = $this->query("closeGeneralForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#reopengeneralforumtopic
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function reopenGeneralForumTopic(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];

		$result = $this->query("reopenGeneralForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#hidegeneralforumtopic
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function hideGeneralForumTopic(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];

		$result = $this->query("hideGeneralForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unhidegeneralforumtopic
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function unhideGeneralForumTopic(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];

		$result = $this->query("unhideGeneralForumTopic", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function unpinAllGeneralForumTopicMessages(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];

		$result = $this->query("unpinAllGeneralForumTopicMessages", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#answercallbackquery
	 * @param string $callbackQueryId
	 * @param array $params
	 * <code>
	 * [
	 *    "text" => string,
	 *    "show_alert" => bool,
	 *    "url" => string,
	 *    "cache_time" => int
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function answerCallbackQuery(
		string $callbackQueryId,
		array $params = []
	): bool
	{
		$body = [
			"callback_query_id" => $callbackQueryId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("text")
			->withBool("show_alert")
			->withString("url")
			->withInt("cache_time")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("answerCallbackQuery", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);
		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getuserchatboosts
	 * @param int|string $chatId
	 * @param int $userId
	 * @return UserChatBoosts
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getUserChatBoosts(
		int|string $chatId,
		int $userId
	): UserChatBoosts
	{
		$body = [
			"chat_id" => $chatId,
			"user_id" => $userId,
		];

		$result = $this->query("getUserChatBoosts", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return UserChatBoosts::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getbusinessconnection
	 * @param string $businessConnectionId
	 * @return BusinessConnection
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function getBusinessConnection(
		string $businessConnectionId
	): BusinessConnection
	{
		$body = [
			"business_connection_id" => $businessConnectionId,
		];

		$result = $this->query("getBusinessConnection", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return BusinessConnection::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmycommands
	 * @param BotCommand $commands
	 * @param array $params
	 * <code>
	 * [
	 *    "scope" => BotCommandScopeDefault|BotCommandScopeAllPrivateChats|BotCommandScopeAllGroupChats|BotCommandScopeAllChatAdministrators|BotCommandScopeChat|BotCommandScopeChatAdministrators|BotCommandScopeChatMember,
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException|ConfigException
	 */
	public function setMyCommands(
		array $commands,
		array $params = []
	): bool
	{
		$body = [
			"commands" => $commands,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClasses(
				"scope",
				BotCommandScopeDefault::class,
				BotCommandScopeAllPrivateChats::class,
				BotCommandScopeAllGroupChats::class,
				BotCommandScopeAllChatAdministrators::class,
				BotCommandScopeChat::class,
				BotCommandScopeChatAdministrators::class,
				BotCommandScopeChatMember::class
			)
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setMyCommands", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];

	}

	/**
	 * @see https://core.telegram.org/bots/api#deletemycommands
	 * @param array $params
	 * <code>
	 * [
	 *    "scope" => BotCommandScopeDefault|BotCommandScopeAllPrivateChats|BotCommandScopeAllGroupChats|BotCommandScopeAllChatAdministrators|BotCommandScopeChat|BotCommandScopeChatAdministrators|BotCommandScopeChatMember,
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function deleteMyCommands(
		array $params = []
	): bool
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClasses(
				"scope",
				BotCommandScopeDefault::class,
				BotCommandScopeAllPrivateChats::class,
				BotCommandScopeAllGroupChats::class,
				BotCommandScopeAllChatAdministrators::class,
				BotCommandScopeChat::class,
				BotCommandScopeChatAdministrators::class,
				BotCommandScopeChatMember::class
			)
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("deleteMyCommands", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getmycommands
	 * @param array $params
	 * <code>
	 * [
	 *    "scope" => BotCommandScopeDefault|BotCommandScopeAllPrivateChats|BotCommandScopeAllGroupChats|BotCommandScopeAllChatAdministrators|BotCommandScopeChat|BotCommandScopeChatAdministrators|BotCommandScopeChatMember,
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return BotCommand[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getMyCommands(
		array $params = []
	): array
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClasses(
				"scope",
				BotCommandScopeDefault::class,
				BotCommandScopeAllPrivateChats::class,
				BotCommandScopeAllGroupChats::class,
				BotCommandScopeAllChatAdministrators::class,
				BotCommandScopeChat::class,
				BotCommandScopeChatAdministrators::class,
				BotCommandScopeChatMember::class
			)
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getMyCommands", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		$commands = [];

		foreach ($responseBody["result"] as $command) {
			$commands[] = BotCommand::fromArray($command);
		}

		return $commands;
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmyname
	 * @param array $params
	 * <code>
	 * [
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setMyName(
		string $name,
		array $params = []
	): bool
	{
		$body = [
			"name" => $name,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("name")
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setMyName", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getmyname
	 * @param array $params
	 * @return BotName
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getMyName(
		array $params = []
	): BotName
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getMyName", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return BotName::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmydescription
	 * @param array $params
	 * <code>
	 * [
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setMyDescription(
		string $description,
		array $params = []
	): bool
	{
		$body = [
			"description" => $description,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("description")
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setMyDescription", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getmydescription
	 * @param array $params
	 * <code>
	 * [
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return BotDescription
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getMyDescription(
		array $params = []
	): BotDescription
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getMyDescription", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return BotDescription::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmyshortdescription
	 * @param array $params
	 * <code>
	 * [
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setMyShortDescription(
		string $shortDescription,
		array $params = []
	): bool
	{
		$body = [
			"short_description" => $shortDescription,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("short_description")
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setMyShortDescription", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getmyshortdescription
	 * @param array $params
	 * <code>
	 * [
	 *    "language_code" => string
	 * ]
	 * </code>
	 * @return BotShortDescription
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getMyShortDescription(
		array $params = []
	): BotShortDescription
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("language_code")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getMyShortDescription", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return BotShortDescription::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setchatmenubutton
	 * @param array $params
	 * <code>
	 * [
	 *    "chat_id" => int,
	 *    "menu_button" => MenuButtonCommands|MenuButtonWebApp|MenuButtonDefault
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setChatMenuButton(
		array $params = []
	): bool
	{
		$body = [];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("chat_id")
			->withClasses(
				"menu_button",
				MenuButtonCommands::class,
				MenuButtonWebApp::class,
				MenuButtonDefault::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setChatMenuButton", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getchatmenubutton
	 * @param array $params
	 * <code>
	 * [
	 *    "chat_id" => int
	 * ]
	 * </code>
	 * @return MenuButtonCommands|MenuButtonWebApp|MenuButtonDefault
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getChatMenuButton(
		array $params = []
	): MenuButtonCommands|MenuButtonWebApp|MenuButtonDefault
	{
		$body = [];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("chat_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getChatMenuButton", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return MenuButton::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setmydefaultadministratorrights
	 * @param array $params
	 * <code>
	 * [
	 *    "rights" => ChatAdministratorRights,
	 *    "for_channels" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setMyDefaultAdministratorRights(
		array $params = []
	): bool
	{
		$body = [];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClass("rights", ChatAdministratorRights::class)
			->withBool("for_channels")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setMyDefaultAdministratorRights", new Post, json_encode($body, true));
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getmydefaultadministratorrights
	 * @param array $params
	 * <code>
	 * [
	 *    "for_channels" => bool
	 * ]
	 * </code>
	 * @return ChatAdministratorRights
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getMyDefaultAdministratorRights(
		array $params = []
	): ChatAdministratorRights
	{
		$body = [];

		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("for_channels")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getMyDefaultAdministratorRights", new Get, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return ChatAdministratorRights::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getupdates
	 * @return Update[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getUpdates(): array
	{
		$result = $this->query("getUpdates");
		$this->checkHttpStatus($result);

		$body = json_decode($result->getBody(), true);

		$this->checkJsonStatus($body);

		$updates = [];

		foreach ($body["result"] as $update) {
			$updates[] = Update::fromArray($update);
		}

		return $updates;
	}

	/**
	 * @see https://core.telegram.org/bots/api#setwebhook
	 * @param string $url
	 * @param array $params
	 * <code>
	 * [
	 *    "certificate" => InputFile,
	 *    "ip_address" => string,
	 *    "max_connections" => int,
	 *    "allowed_updates" => string[],
	 *    "drop_pending_updates" => bool,
	 *    "secret_token" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setWebhook(
		string $url,
		array $params = []
	): bool
	{
		$body = [
			"url" => $url,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClass("certificate", InputFile::class)
			->withString("ip_address")
			->withInt("max_connections")
			->withArrayOfString("allowed_updates")
			->withBool("drop_pending_updates")
			->withString("secret_token")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return $this->sendFilesByMethod($body, "setWebhook");
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletewebhook
	 * @param array $params
	 * <code>
	 * [
	 *    "drop_pending_updates" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function deleteWebhook(
		array $params = []
	): bool
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("drop_pending_updates")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("deleteWebhook", new Post, $body);
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getwebhookinfo
	 * @return WebhookInfo
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getWebhookInfo(): WebHookInfo
	{
		$result = $this->query("getWebhookInfo");
		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return WebhookInfo::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editmessagetext
	 * @param string $text
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "parse_mode" => string,
	 *    "entities" => MessageEntity[],
	 *    "link_preview_options" => LinkPreviewOptions,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editMessageText(
		string $text,
		array $params = []
	): Message|bool
	{
		$body = [
			"text" => $text,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withString("parse_mode")
			->withArrayOfClass("entities", MessageEntity::class)
			->withClass("link_preview_options", LinkPreviewOptions::class)
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editMessageText", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["inline_message_id"] ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editmessagecaption
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "parse_mode" => string,
	 *    "caption_entities" => MessageEntity[],
	 *    "show_caption_above_media" => bool,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editMessageCaption(
		array $params = []
	): Message|bool
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withString("caption")
			->withArrayOfClass("caption_entities", MessageEntity::class)
			->withBool("show_caption_above_media")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editMessageCaption", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $body["inline_message_id"] ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editmessagemedia
	 * @param InputMediaAnimation|InputMediaDocument|InputMediaAudio|InputMediaPhoto|InputMediaVideo $media
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editMessageMedia(
		InputMediaAnimation|InputMediaDocument|InputMediaAudio|InputMediaPhoto|InputMediaVideo $media,
		array $params = []
	): Message|bool
	{
		$body = [
			"media" => $media,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->sendFilesByMethod($body, "editMessageMedia");

		return $params["inline_message_id"] ? $result : Message::fromArray($result);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editmessagelivelocation
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "live_period" => int,
	 *    "horizontal_accuracy" => float,
	 *    "heading" => int,
	 *    "proximity_alert_radius" => int,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editMessageLiveLocation(
		float $latitude,
		float $longitude,
		array $params = []
	): Message|bool
	{
		$body = [
			"latitude" => $latitude,
			"longitude" => $longitude,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withInt("live_period")
			->withFloat("horizontal_accuracy")
			->withInt("heading")
			->withInt("proximity_alert_radius")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editMessageLiveLocation", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $body["inline_message_id"] ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#stopmessagelivelocation
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function stopMessageLiveLocation(
		array $params = []
	): Message|bool
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("stopMessageLiveLocation", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $body["inline_message_id"] ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#editmessagereplymarkup
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "chat_id" => int|string,
	 *    "message_id" => int,
	 *    "inline_message_id" => string,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editMessageReplyMarkup(
		array $params = []
	): Message|bool
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withInt("message_id")
			->withString("inline_message_id")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("editMessageReplyMarkup", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $body["inline_message_id"] ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#stoppoll
	 * @param int|string $chatId
	 * @param int $messageId
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Poll
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function stopPoll(
		int|string $chatId,
		int $messageId,
		array $params = []
	): Poll
	{
		$body = [
			"chat_id" => $chatId,
			"message_id" => $messageId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("stopPoll", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Poll::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletemessage
	 * @param int|string $chatId
	 * @param int $messageId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function deleteMessage(
		int|string $chatId,
		int $messageId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
			"message_id" => $messageId,
		];
		$result = $this->query("deleteMessage", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendsticker
	 * @param int|string $chatId
	 * @param InputFile|string $sticker
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "emoji" => string,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardRemove | ForceReply
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendSticker(
		int|string $chatId,
		InputFile|string $sticker,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"sticker" => $sticker,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withString("emoji")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClasses(
				"reply_markup",
				InlineKeyboardMarkup::class,
				ReplyKeyboardMarkup::class,
				ReplyKeyboardRemove::class,
				ForceReply::class
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->sendFilesByMethod($body, "sendSticker");

		return Message::fromArray($result);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getstickerset
	 * @param string $name
	 * @return StickerSet
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getStickerSet(
		string $name
	): StickerSet
	{
		$body = [
			"name" => $name,
		];
		$result = $this->query("getStickerSet", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return StickerSet::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getcustomemojistickers
	 * @param string[] $customEmojiIds
	 * @return Sticker[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getCustomEmojiStickers(
		array $customEmojiIds
	): array
	{
		if (!$customEmojiIds) {
			throw new InvalidArgumentException("Emoji ids dont must be empty");
		}

		foreach ($customEmojiIds as $emoji) {
			if (!is_string($emoji)) {
				throw new InvalidArgumentException("Emoji ids must be strings");
			}
		}

		$body = [
			"custom_emoji_ids" => $customEmojiIds,
		];

		$result = $this->query("getCustomEmojiStickers", new Get, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return array_map(static fn($item) => Sticker::fromArray($item), $responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#uploadstickerfile
	 * @param int $userId
	 * @param InputFile $sticker
	 * @param string $stickerFormat
	 * @return File
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function uploadStickerFile(
		int $userId,
		InputFile $sticker,
		string $stickerFormat
	): File
	{
		$body = [
			"user_id" => $userId,
			"sticker" => $sticker,
			"sticker_format" => $stickerFormat,
		];
		$result = $this->sendFilesByMethod($body, "uploadStickerFile");

		return File::fromArray($result);
	}

	/**
	 * @see https://core.telegram.org/bots/api#createnewstickerset
	 * @param int $userId
	 * @param string $name
	 * @param string $title
	 * @param InputSticker $stickers
	 * @param array $params
	 * <code>
	 * [
	 *    "sticker_type" => string,
	 *    "needs_repainting" => bool
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function createNewStickerSet(
		int $userId,
		string $name,
		string $title,
		array $stickers,
		array $params = []
	): bool
	{
		if (!$stickers) {
			throw new InvalidArgumentException("Stickers array must not be empty");
		}
		foreach ($stickers as $sticker) {
			if (!$sticker instanceof InputSticker) {
				throw new InvalidArgumentException("Stickers array must contain InputSticker objects");
			}
		}

		$body = [
			"user_id" => $userId,
			"name" => $name,
			"title" => $title,
			"stickers" => $stickers,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("sticker_type")
			->withBool("needs_repainting")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return $this->sendFilesByMethod($body, "createNewStickerSet");
	}

	/**
	 * @see https://core.telegram.org/bots/api#addstickertoset
	 * @param int $userId
	 * @param string $name
	 * @param InputSticker $sticker
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function addStickerToSet(
		int $userId,
		string $name,
		InputSticker $sticker
	): bool
	{
		$body = [
			"user_id" => $userId,
			"name" => $name,
			"sticker" => $sticker->jsonSerialize(),
		];

		return $this->sendFilesByMethod($body, "addStickerToSet");
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickerpositioninset
	 * @param string $sticker
	 * @param int $position
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerPositionInSet(
		string $sticker,
		int $position
	): bool
	{
		$body = [
			"sticker" => $sticker,
			"position" => $position,
		];
		$result = $this->query("setStickerPositionInSet", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletestickerfromset
	 * @param string $sticker
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function deleteStickerFromSet(
		string $sticker
	): bool
	{
		$body = [
			"sticker" => $sticker,
		];
		$result = $this->query("deleteStickerFromSet", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#replacestickerinset
	 * @param int $userId
	 * @param string $name
	 * @param string $oldSticker
	 * @param InputSticker $sticker
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function replaceStickerInSet(
		int $userId,
		string $name,
		string $oldSticker,
		InputSticker $sticker
	): bool
	{
		$body = [
			"user_id" => $userId,
			"name" => $name,
			"old_sticker" => $oldSticker,
			"sticker" => $sticker->jsonSerialize(),
		];

		return $this->sendFilesByMethod($body, "replaceStickerInSet");
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickeremojilist
	 * @param string $sticker
	 * @param string[] $emojiList
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerEmojiList(
		string $sticker,
		array $emojiList
	): bool
	{
		$body = [
			"sticker" => $sticker,
			"emoji_list" => $emojiList,
		];

		$result = $this->query("setStickerEmojiList", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickerkeywords
	 * @param string $sticker
	 * @param array $params
	 * <code>
	 * [
	 *    "keywords" => string[]
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerKeywords(
		string $sticker,
		array $params = []
	): bool
	{
		$body = [
			"sticker" => $sticker,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withArrayOfString("keywords")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setStickerKeywords", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickermaskposition
	 * @param string $sticker
	 * @param array $params
	 * <code>
	 * [
	 *    "mask_position" => MaskPosition
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerMaskPosition(
		string $sticker,
		array $params = []
	): bool
	{
		$body = [
			"sticker" => $sticker,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withClass("mask_position", MaskPosition::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setStickerMaskPosition", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickersettitle
	 * @param string $name
	 * @param string $title
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerSetTitle(
		string $name,
		string $title
	): bool
	{
		$body = [
			"name" => $name,
			"title" => $title,
		];
		$result = $this->query("setStickerSetTitle", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setstickersetthumbnail
	 * @param string $name
	 * @param int $userId
	 * @param string $format
	 * @param array $params
	 * <code>
	 * [
	 *    "thumbnail" => InputFile|string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setStickerSetThumbnail(
		string $name,
		int $userId,
		string $format,
		array $params = []
	): bool
	{
		$body = [
			"name" => $name,
			"user_id" => $userId,
			"format" => $format,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withTypes(
				"thumbnail",
				InputFile::class,
				AdditionalParameters::STRING
			)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		return $this->sendFilesByMethod($body, "setStickerSetThumbnail");
	}

	/**
	 * @see https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
	 * @param string $name
	 * @param array $params
	 * <code>
	 * [
	 *    "custom_emoji_id" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setCustomEmojiStickerSetThumbnail(
		string $name,
		array $params = []
	): bool
	{
		$body = [
			"name" => $name,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("custom_emoji_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("setCustomEmojiStickerSetThumbnail", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#deletestickerset
	 * @param string $name
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function deleteStickerSet(
		string $name
	): bool
	{
		$body = [
			"name" => $name,
		];
		$result = $this->query("deleteStickerSet", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getavailablegifts
	 * @return Gifts
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getAvailableGifts(): Gifts
	{
		$result = $this->query("getAvailableGifts");

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Gifts::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendgift
	 * @param string $giftId
	 * @param array $params
	 * <code>
	 * [
	 *    "user_id" => int,
	 *    "chat_id" => int|string,
	 *    "pay_for_upgrade" => bool,
	 *    "text" => string,
	 *    "text_parse_mode" => string,
	 *    "text_entities" => MessageEntity[]
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendGift(
		string $giftId,
		array $params = []
	): bool
	{
		$body = [
			"gift_id" => $giftId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("user_id")
			->withTypes(
				"chat_id",
				AdditionalParameters::INT,
				AdditionalParameters::STRING
			)
			->withBool("pay_for_upgrade")
			->withString("text")
			->withString("text_parse_mode")
			->withArrayOfClass("text_entities", MessageEntity::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("sendGift", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#verifyuser
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "custom_description" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function verifyUser(
		int $userId,
		array $params = []
	): bool
	{
		$body = [
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("custom_description")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("verifyUser", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#verifychat
	 * @param int|string $chatId
	 * @param array $params
	 * <code>
	 * [
	 *    "custom_description" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function verifyChat(
		int|string $chatId,
		array $params = []
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("custom_description")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("verifyChat", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#removeuserverification
	 * @param int $userId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function removeUserVerification(
		int $userId
	): bool
	{
		$body = [
			"user_id" => $userId,
		];
		$result = $this->query("removeUserVerification", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#removechatverification
	 * @param int|string $chatId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function removeChatVerification(
		int|string $chatId
	): bool
	{
		$body = [
			"chat_id" => $chatId,
		];
		$result = $this->query("removeChatVerification", new Post, $body);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#answerinlinequery
	 * @param string $inlineQueryId
	 * @param (InlineQueryResultCachedAudio
	 * | InlineQueryResultCachedDocument
	 * | InlineQueryResultCachedGif
	 * | InlineQueryResultCachedMpeg4Gif
	 * | InlineQueryResultCachedPhoto
	 * | InlineQueryResultCachedSticker
	 * | InlineQueryResultCachedVideo
	 * | InlineQueryResultCachedVoice
	 * | InlineQueryResultArticle
	 * | InlineQueryResultAudio
	 * | InlineQueryResultDocument
	 * | InlineQueryResultGif
	 * | InlineQueryResultMpeg4Gif
	 * | InlineQueryResultContact
	 * | InlineQueryResultGame
	 * | InlineQueryResultLocation
	 * | InlineQueryResultPhoto
	 * | InlineQueryResultVenue
	 * | InlineQueryResultVideo
	 * | InlineQueryResultVoice)[] $results
	 * @param array $params
	 * <code>
	 * [
	 *    "cache_time" => int,
	 *    "is_personal" => bool,
	 *    "next_offset" => string,
	 *    "button" => InlineQueryResultsButton
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function answerInlineQuery(
		string $inlineQueryId,
		array $results,
		array $params = []
	): bool
	{
		if (!$results) {
			throw new InvalidArgumentException("Results array cannot be empty");
		}

		foreach ($results as $result) {
			if (
				!$result instanceof InlineQueryResultCachedAudio
				&& !$result instanceof InlineQueryResultCachedDocument
				&& !$result instanceof InlineQueryResultCachedGif
				&& !$result instanceof InlineQueryResultCachedMpeg4Gif
				&& !$result instanceof InlineQueryResultCachedPhoto
				&& !$result instanceof InlineQueryResultCachedSticker
				&& !$result instanceof InlineQueryResultCachedVideo
				&& !$result instanceof InlineQueryResultCachedVoice
				&& !$result instanceof InlineQueryResultArticle
				&& !$result instanceof InlineQueryResultAudio
				&& !$result instanceof InlineQueryResultDocument
				&& !$result instanceof InlineQueryResultGif
				&& !$result instanceof InlineQueryResultMpeg4Gif
				&& !$result instanceof InlineQueryResultContact
				&& !$result instanceof InlineQueryResultGame
				&& !$result instanceof InlineQueryResultLocation
				&& !$result instanceof InlineQueryResultPhoto
				&& !$result instanceof InlineQueryResultVenue
				&& !$result instanceof InlineQueryResultVideo
				&& !$result instanceof InlineQueryResultVoice
			) {
				throw new InvalidArgumentException("Invalid result type");
			}
		}

		$body = [
			"inline_query_id" => $inlineQueryId,
			"results" => $results,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("cache_time")
			->withBool("is_personal")
			->withString("next_offset")
			->withClass("button", InlineQueryResultsButton::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("answerInlineQuery", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#answerwebappquery
	 * @param string $webAppQueryId
	 * @param InlineQueryResultCachedAudio|InlineQueryResultCachedDocument|InlineQueryResultCachedGif|InlineQueryResultCachedMpeg4Gif|InlineQueryResultCachedPhoto|InlineQueryResultCachedSticker|InlineQueryResultCachedVideo|InlineQueryResultCachedVoice|InlineQueryResultArticle|InlineQueryResultAudio|InlineQueryResultDocument|InlineQueryResultGif|InlineQueryResultMpeg4Gif|InlineQueryResultContact|InlineQueryResultGame|InlineQueryResultLocation|InlineQueryResultPhoto|InlineQueryResultVenue|InlineQueryResultVideo|InlineQueryResultVoice $result
	 * @return SentWebAppMessage
	 */
	public function answerWebAppQuery(
		string $webAppQueryId,
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
		| InlineQueryResultVoice $result
	): SentWebAppMessage
	{
		$body = [
			"web_app_query_id" => $webAppQueryId,
			"result" => $result,
		];
		$result = $this->query("answerWebAppQuery", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return SentWebAppMessage::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#savepreparedinlinemessage
	 * @param int $userId
	 * @param InlineQueryResultCachedAudio|InlineQueryResultCachedDocument|InlineQueryResultCachedGif|InlineQueryResultCachedMpeg4Gif|InlineQueryResultCachedPhoto|InlineQueryResultCachedSticker|InlineQueryResultCachedVideo|InlineQueryResultCachedVoice|InlineQueryResultArticle|InlineQueryResultAudio|InlineQueryResultDocument|InlineQueryResultGif|InlineQueryResultMpeg4Gif|InlineQueryResultContact|InlineQueryResultGame|InlineQueryResultLocation|InlineQueryResultPhoto|InlineQueryResultVenue|InlineQueryResultVideo|InlineQueryResultVoice $result
	 * @param array $params
	 * <code>
	 * [
	 *    "allow_user_chats" => bool,
	 *    "allow_bot_chats" => bool,
	 *    "allow_group_chats" => bool,
	 *    "allow_channel_chats" => bool
	 * ]
	 * </code>
	 * @return PreparedInlineMessage
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function savePreparedInlineMessage(
		int $userId,
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
		| InlineQueryResultVoice $result,
		array $params = []
	): PreparedInlineMessage
	{
		$body = [
			"user_id" => $userId,
			"result" => $result,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("allow_user_chats")
			->withBool("allow_bot_chats")
			->withBool("allow_group_chats")
			->withBool("allow_channel_chats")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("savePreparedInlineMessage", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return PreparedInlineMessage::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendinvoice
	 * @param int|string $chatId
	 * @param string $title
	 * @param string $description
	 * @param string $payload
	 * @param string $currency
	 * @param LabeledPrice[] $prices
	 * @param array $params
	 * <code>
	 * [
	 *    "message_thread_id" => int,
	 *    "provider_token" => string,
	 *    "max_tip_amount" => int,
	 *    "suggested_tip_amounts" => int[],
	 *    "start_parameter" => string,
	 *    "provider_data" => string,
	 *    "photo_url" => string,
	 *    "photo_size" => int,
	 *    "photo_width" => int,
	 *    "photo_height" => int,
	 *    "need_name" => bool,
	 *    "need_phone_number" => bool,
	 *    "need_email" => bool,
	 *    "need_shipping_address" => bool,
	 *    "send_phone_number_to_provider" => bool,
	 *    "send_email_to_provider" => bool,
	 *    "is_flexible" => bool,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendInvoice(
		int|string $chatId,
		string $title,
		string $description,
		string $payload,
		string $currency,
		array $prices,
		array $params = []
	): Message
	{
		if (!$prices){
			throw new InvalidArgumentException("At least one price must be provided.");
		}

		foreach ($prices as $price) {
			if (!$price instanceof LabeledPrice) {
				throw new InvalidArgumentException("All prices must be instances of LabeledPrice.");
			}
		}

		$body = [
			"chat_id" => $chatId,
			"title" => $title,
			"description" => $description,
			"payload" => $payload,
			"currency" => $currency,
			"prices" => $prices,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("message_thread_id")
			->withString("provider_token")
			->withInt("max_tip_amount")
			->withArrayOfInt("suggested_tip_amounts")
			->withString("start_parameter")
			->withString("provider_data")
			->withString("photo_url")
			->withInt("photo_size")
			->withInt("photo_width")
			->withInt("photo_height")
			->withBool("need_name")
			->withBool("need_phone_number")
			->withBool("need_email")
			->withBool("need_shipping_address")
			->withBool("send_phone_number_to_provider")
			->withBool("send_email_to_provider")
			->withBool("is_flexible")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("sendInvoice", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#createinvoicelink
	 * @param string $title
	 * @param string $description
	 * @param string $payload
	 * @param string $currency
	 * @param LabeledPrice[] $prices
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "provider_token" => string,
	 *    "subscription_period" => int,
	 *    "max_tip_amount" => int,
	 *    "suggested_tip_amounts" => int[],
	 *    "provider_data" => string,
	 *    "photo_url" => string,
	 *    "photo_size" => int,
	 *    "photo_width" => int,
	 *    "photo_height" => int,
	 *    "need_name" => bool,
	 *    "need_phone_number" => bool,
	 *    "need_email" => bool,
	 *    "need_shipping_address" => bool,
	 *    "send_phone_number_to_provider" => bool,
	 *    "send_email_to_provider" => bool,
	 *    "is_flexible" => bool
	 * ]
	 * </code>
	 * @return string
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function createInvoiceLink(
		string $title,
		string $description,
		string $payload,
		string $currency,
		array $prices,
		array $params = []
	): string
	{
		if (!$prices) {
			throw new InvalidArgumentException("At least one price must be provided.");
		}

		foreach ($prices as $price) {
			if (!$price instanceof LabeledPrice) {
				throw new InvalidArgumentException("All prices must be instances of LabeledPrice.");
			}
		}

		$body = [
			"title" => $title,
			"description" => $description,
			"payload" => $payload,
			"currency" => $currency,
			"prices" => $prices,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withString("provider_token")
			->withInt("subscription_period")
			->withInt("max_tip_amount")
			->withArrayOfInt("suggested_tip_amounts")
			->withString("provider_data")
			->withString("photo_url")
			->withInt("photo_size")
			->withInt("photo_width")
			->withInt("photo_height")
			->withBool("need_name")
			->withBool("need_phone_number")
			->withBool("need_email")
			->withBool("need_shipping_address")
			->withBool("send_phone_number_to_provider")
			->withBool("send_email_to_provider")
			->withBool("is_flexible")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("createInvoiceLink", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#answershippingquery
	 * @param string $shippingQueryId
	 * @param bool $ok
	 * @param array $params
	 * <code>
	 * [
	 *    "shipping_options" => ShippingOption[],
	 *    "error_message" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function answerShippingQuery(
		string $shippingQueryId,
		bool $ok,
		array $params = []
	): bool
	{
		$body = [
			"shipping_query_id" => $shippingQueryId,
			"ok" => $ok,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withArrayOfClass("shipping_options", ShippingOption::class)
			->withString("error_message")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("answerShippingQuery", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#answerprecheckoutquery
	 * @param string $preCheckoutQueryId
	 * @param bool $ok
	 * @param array $params
	 * <code>
	 * [
	 *    "error_message" => string
	 * ]
	 * </code>
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function answerPreCheckoutQuery(
		string $preCheckoutQueryId,
		bool $ok,
        array $params = []
	): bool
	{
		$body = [
			"pre_checkout_query_id" => $preCheckoutQueryId,
			"ok" => $ok,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("error_message")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("answerPreCheckoutQuery", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#getstartransactions
	 * @param array $params
	 * <code>
	 * [
	 *    "offset" => int,
	 *    "limit" => int
	 * ]
	 * </code>
	 * @return StarTransactions
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getStarTransactions(
		array $params = []
	): StarTransactions
	{
		$body = [];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("offset")
			->withInt("limit")
		;
		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query("getStarTransactions", new Get, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return StarTransactions::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#refundstarpayment
	 * @param int $userId
	 * @param string $telegramPaymentChargeId
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function refundStarPayment(
		int $userId,
		string $telegramPaymentChargeId
	): bool
	{
		$body = [
			"user_id" => $userId,
			"telegram_payment_charge_id" => $telegramPaymentChargeId,
		];
		$result = $this->query("refundStarPayment", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#edituserstarsubscription
	 * @param int $userId
	 * @param string $telegramPaymentChargeId
	 * @param bool $isCanceled
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function editUserStarSubscription(
		int $userId,
		string $telegramPaymentChargeId,
		bool $isCanceled
	): bool
	{
		$body = [
			"user_id" => $userId,
			"telegram_payment_charge_id" => $telegramPaymentChargeId,
			"is_canceled" => $isCanceled,
		];
		$result = $this->query("editUserStarSubscription", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#setpassportdataerrors
	 * @param int $userId
	 * @param (PassportElementErrorDataField
	 * | PassportElementErrorFrontSide
	 * | PassportElementErrorReverseSide
	 * | PassportElementErrorSelfie
	 * | PassportElementErrorFile
	 * | PassportElementErrorFiles
	 * | PassportElementErrorTranslationFile
	 * | PassportElementErrorTranslationFiles
	 * | PassportElementErrorUnspecified)[] $errors
	 * @return bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setPassportDataErrors(
		int $userId,
		array $errors
	): bool
	{
		$body = [
			"user_id" => $userId,
			"errors" => $errors,
		];

		$result = $this->query("setPassportDataErrors", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	/**
	 * @see https://core.telegram.org/bots/api#sendgame
	 * @param int $chatId
	 * @param string $gameShortName
	 * @param array $params
	 * <code>
	 * [
	 *    "business_connection_id" => string,
	 *    "message_thread_id" => int,
	 *    "disable_notification" => bool,
	 *    "protect_content" => bool,
	 *    "allow_paid_broadcast" => bool,
	 *    "message_effect_id" => string,
	 *    "reply_parameters" => ReplyParameters,
	 *    "reply_markup" => InlineKeyboardMarkup
	 * ]
	 * </code>
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function sendGame(
		int $chatId,
		string $gameShortName,
		array $params = []
	): Message
	{
		$body = [
			"chat_id" => $chatId,
			"game_short_name" => $gameShortName,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withString("business_connection_id")
			->withInt("message_thread_id")
			->withBool("disable_notification")
			->withBool("protect_content")
			->withBool("allow_paid_broadcast")
			->withString("message_effect_id")
			->withClass("reply_parameters", ReplyParameters::class)
			->withClass("reply_markup", InlineKeyboardMarkup::class)
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("sendGame", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#setgamescore
	 * @param int $userId
	 * @param int $score
	 * @param array $params
	 * <code>
	 * [
	 *    "force" => bool,
	 *    "disable_edit_message" => bool,
	 *    "chat_id" => int,
	 *    "message_id" => int,
	 *    "inline_message_id" => string
	 * ]
	 * </code>
	 * @return Message|bool
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function setGameScore(
		int $userId,
		int $score,
		array $params = []
	): Message | bool
	{
		$body = [
			"user_id" => $userId,
			"score" => $score,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withBool("force")
			->withBool("disable_edit_message")
			->withInt("chat_id")
			->withInt("message_id")
			->withString("inline_message_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("setGameScore", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return isset($params["inline_message_id"]) ? $responseBody["result"] : Message::fromArray($responseBody["result"]);
	}

	/**
	 * @see https://core.telegram.org/bots/api#getgamehighscores
	 * @param int $userId
	 * @param array $params
	 * <code>
	 * [
	 *    "chat_id" => int,
	 *    "message_id" => int,
	 *    "inline_message_id" => string
	 * ]
	 * </code>
	 * @return GameHighScore[]
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	public function getGameHighScores(
		int $userId,
		array $params = []
	): array
	{
		$body = [
			"user_id" => $userId,
		];
		$additionalParameters = new AdditionalParameters($params);
		$additionalParameters
			->withInt("chat_id")
			->withInt("message_id")
			->withString("inline_message_id")
		;
		$body = array_merge($body, $additionalParameters->getParameters());

		$result = $this->query("getGameHighScores", new Post, json_encode($body, true));

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return array_map(fn($item) => GameHighScore::fromArray($item), $responseBody["result"]);
	}

	/**
	 * Возвращает данные, переданные в вебхук
	 * @return Update
	 */
	protected function getWebhookData(): Update
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data, true);
		return Update::fromArray($data);
	}

	/**
	 * @param Response $response
	 * @return void
	 * @throws InvalidHttpStatusException
	 */
	protected function checkHttpStatus(Response &$response): void
	{
		if ($response->getStatusCode() != 200) {
			throw new InvalidHttpStatusException("Invalid response: " . $response->getStatus() . PHP_EOL . $response->getBody());
		}
	}

	/**
	 * @param array|string $json
	 * @return void
	 * @throws InvalidResponseException
	 */
	protected function checkJsonStatus(array|string $json): void
	{
		if (is_string($json)) {
			$json = json_decode($json, true);

		}

		if (!$json["ok"]) {
			throw new InvalidResponseException("Error: " . $json["error_code"] . " - " . $json["description"]);
		}
	}

	/**
	 * @param array $body
	 * @param string $method
	 * @return Message
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
	 */
	protected function sendFilesByMethod(
		array &$body,
		string $method
	): mixed
	{
		$headers = [];
		$isMultipart = false;

		foreach ($body as $code => $value) {
			if ($value instanceof InputFile) {
				$isMultipart = true;
				break;
			} elseif (is_array($value)) {
				foreach ($value as $item) {
					if ($item instanceof InputFile) {
						$isMultipart = true;
						break 2;
					}
				}
			}
		}

		if ($isMultipart) {
			$headers[] = "Content-Type: multipart/form-data";
		} else {
			$headers[] = "Content-Type: application/json";
		}

		$result = $this->query(
			$method,
			new Post,
			$isMultipart ? $body : json_encode($body, true),
			...$headers
		);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);

		return $responseBody["result"];
	}

	protected function fillMediaToRequestBody(
		array &$body,
		InputMediaAudio|InputMediaDocument|InputMediaPhoto|InputMediaVideo|InputPaidMediaPhoto|InputPaidMediaVideo $mediaFile
	): void
	{
		if (strstr($mediaFile->getMedia(), "attach://") !== false) {
			$filename = trim("attach://", $mediaFile->getMedia());

			$file = new InputFile($filename);
			$arrayMediaFile = $mediaFile->jsonSerialize();
			$exploded = explode(DIRECTORY_SEPARATOR, $arrayMediaFile["media"]);
			$arrayMediaFile["media"] = "attach://" . end($exploded);

			$body["media"][] = $arrayMediaFile;
			$body[end($exploded)] = $file;
		} elseif (strstr($mediaFile->getMedia(), $_SERVER["DOCUMENT_ROOT"]) !== false) {

			$file = new InputFile($mediaFile->getMedia());
			$arrayMediaFile = $mediaFile->jsonSerialize();
			$exploded = explode(DIRECTORY_SEPARATOR, $arrayMediaFile["media"]);
			$arrayMediaFile["media"] = "attach://" . end($exploded);

			$body["media"][] = $arrayMediaFile;
			$body[end($exploded)] = $file;
		} else {
			$body["media"][] = $mediaFile->jsonSerialize();
		}
	}
}
