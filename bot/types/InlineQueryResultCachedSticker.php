<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 */
class InlineQueryResultCachedSticker implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $stickerFileId;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	| null $inputMessageContent;

	public function __construct(
		string $type = "sticker",
		string $id = "",
		string $stickerFileId = "",
		?InlineKeyboardMarkup $replyMarkup = null,
		InputTextMessageContent
		| InputLocationMessageContent
		| InputVenueMessageContent
		| InputContactMessageContent
		| InputInvoiceMessageContent
		| null $inputMessageContent = null
	)
	{
		$this->type = $type;
		$this->id = $id;
		$this->stickerFileId = $stickerFileId;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "sticker") {
			throw new \InvalidArgumentException("Type must be 'sticker'");
		}
	}

	public static function fromArray(array $array): InlineQueryResultCachedSticker
	{
		return new static(
			$array["type"] ?? "sticker",
			$array["id"] ?? "",
			$array["sticker_file_id"] ?? "",
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"sticker_file_id" => $this->stickerFileId,
		];

		if (isset($this->replyMarkup)) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}
		if (isset($this->inputMessageContent)) {
			$array["input_message_content"] = $this->inputMessageContent->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getStickerFileId(): string
	{
		return $this->stickerFileId;
	}

	/**
	 * @return InlineKeyboardMarkup|null
	 */
	public function getReplyMarkup(): ?InlineKeyboardMarkup
	{
		return $this->replyMarkup;
	}

	/**
	 * @return InputContactMessageContent|InputInvoiceMessageContent|InputLocationMessageContent|InputTextMessageContent|InputVenueMessageContent|null
	 */
	public function getInputMessageContent(): InputTextMessageContent|InputContactMessageContent|InputVenueMessageContent|InputInvoiceMessageContent|InputLocationMessageContent|null
	{
		return $this->inputMessageContent;
	}
}