<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#callbackquery
 */
class CallbackQuery implements \JsonSerializable
{
	protected string $id;
	protected User $from;
	protected ?MaybeInaccessibleMessage $message;
	protected ?string $inlineMessageId;
	protected string $chatInstance;
	protected ?string $data;
	protected ?string $gameShortName;

	public function __construct(
		string $id,
		User $from,
		?MaybeInaccessibleMessage $message = null,
		?string $inlineMessageId = null,
		string $chatInstance = "",
		?string $data = null,
		?string $gameShortName = null
	)
	{
		$this->id = $id;
		$this->from = $from;
		$this->message = $message;
		$this->inlineMessageId = $inlineMessageId;
		$this->chatInstance = $chatInstance;
		$this->data = $data;
		$this->gameShortName = $gameShortName;
	}

	public static function fromArray(array $array): CallbackQuery
	{
		return new static(
			$array["id"],
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["message"] ? MaybeInaccessibleMessage::fromArray($array["message"]) : null,
			$array["inline_message_id"],
			$array["chat_instance"] ?? "",
			$array["data"],
			$array["game_short_name"]
		);
	}

	public function jsonSerialize()
	{
		return [
			"id" => $this->id,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"message" => $this->message ? $this->message->jsonSerialize() : null,
			"inline_message_id" => $this->inlineMessageId,
			"chat_instance" => $this->chatInstance,
			"data" => $this->data,
			"game_short_name" => $this->gameShortName,
		];
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return User
	 */
	public function getFrom(): User
	{
		return $this->from;
	}

	/**
	 * @return MaybeInaccessibleMessage|null
	 */
	public function getMessage(): ?MaybeInaccessibleMessage
	{
		return $this->message;
	}

	/**
	 * @return string|null
	 */
	public function getInlineMessageId(): ?string
	{
		return $this->inlineMessageId;
	}

	/**
	 * @return string
	 */
	public function getChatInstance(): string
	{
		return $this->chatInstance;
	}

	/**
	 * @return string|null
	 */
	public function getData(): ?string
	{
		return $this->data;
	}

	/**
	 * @return string|null
	 */
	public function getGameShortName(): ?string
	{
		return $this->gameShortName;
	}
}