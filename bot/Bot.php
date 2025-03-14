<?php namespace Telegram;

use Telegram\Bot\Types\ForceReply;
use Telegram\Bot\Types\InlineKeyboardMarkup;
use Telegram\Bot\Types\InputFile;
use Telegram\Bot\Types\LinkPreviewOptions;
use Telegram\Bot\Types\Message;
use Telegram\Bot\Types\MessageEntity;
use Telegram\Bot\Types\MessageId;
use Telegram\Bot\Types\ReplyKeyboardMarkup;
use Telegram\Bot\Types\ReplyKeyboardRemove;
use Telegram\Bot\Types\ReplyParameters;
use Telegram\Bot\Types\Update;
use Telegram\Bot\Types\User;
use Telegram\Bot\Utils\AdditionalParameters;
use Telegram\Exceptions\InvalidHttpStatusException;
use Telegram\Exceptions\InvalidResponseException;
use Telegram\Http\Curl;
use Telegram\Http\Methods\Get;
use Telegram\Http\Methods\Post;
use Telegram\Http\Response;
use Telegram\Http\Methods\Base as HttpMethod;

class Bot
{
	public function getToken(): string
	{
		return "8022035916:AAGGaayNY2kav0srr-HB2JCYVmGCTKPOl9g";
	}

	public function query(string $method = "", HttpMethod $httpMethod = null, mixed $body = [], string ...$headers): Response
	{
		//TODO: в фабрику

		$curl = new Curl("https://api.telegram.org/bot" . $this->getToken() . "/" . $method, $httpMethod ?? new Get);
		
		if ($headers){
			foreach ($headers as $header){
				$curl->addHeader($header);
			}
		}
		else {
			$curl->addHeader("Content-Type: application/json");
			$curl->addHeader("Accept: application/json");
		}

		if ($body) {
			$curl->setBody($body);
		}

		return $curl->query();
	}

	/**
	 * @see https://core.telegram.org/bots/api#getme
	 *
	 * @return User
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
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
	 *
	 * @return array
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
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
	 *
	 * @return array
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
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
	 *
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
	 * @throws \InvalidArgumentException
	 * @throws InvalidHttpStatusException
	 * @throws InvalidResponseException
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
	 *
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
	 * @throws InvalidResponseException
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
	 *
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
	 * @throws InvalidResponseException
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
				throw new \InvalidArgumentException("Message IDs must be integers");
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
	 *
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
	 * @throws InvalidResponseException
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
	 *
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
	 * @throws InvalidResponseException
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
				throw new \InvalidArgumentException("Message IDs must be integers");
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
	 *
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

		$headers = [];

		if (is_string($photo)){
			$headers[] = "Content-Type: application/json";
		}
		else{
			$headers[] = "Content-Type: multipart/form-data";
		}

		$body = array_merge($body, $additionalParameters->getParameters());
		$result = $this->query(
			"sendPhoto",
			new Post,
			is_string($photo) ? json_encode($body, true) : $body,
			...$headers
		);

		$this->checkHttpStatus($result);

		$responseBody = json_decode($result->getBody(), true);

		$this->checkJsonStatus($responseBody);
		
		return Message::fromArray($responseBody["result"]);
	}

	/**
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

	public function setWebhook()
	{
		//TODO: fill
	}

	public function deleteWebhook()
	{
		//TODO: fill
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
}
