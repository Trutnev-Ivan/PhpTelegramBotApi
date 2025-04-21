<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultaudio
 */
class InlineQueryResultAudio implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $audioUrl;
	protected string $title;
	protected ?string $caption;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $captionEntities;
	protected ?string $performer;
	protected ?int $audioDuration;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected InputTextMessageContent
	| InputLocationMessageContent
	| InputVenueMessageContent
	| InputContactMessageContent
	| InputInvoiceMessageContent
	| null $inputMessageContent;

	public function __construct(
		string $type = "audio",
		string $id = "",
		string $audioUrl = "",
		string $title = "",
		?string $caption = null,
		?string $parseMode = null,
		array $captionEntities = [],
		?string $performer = null,
		?int $audioDuration = null,
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
		$this->audioUrl = $audioUrl;
		$this->title = $title;
		$this->caption = $caption;
		$this->parseMode = $parseMode;
		$this->captionEntities = $captionEntities;
		$this->performer = $performer;
		$this->audioDuration = $audioDuration;
		$this->replyMarkup = $replyMarkup;
		$this->inputMessageContent = $inputMessageContent;

		if ($this->type != "audio") {
			throw new \InvalidArgumentException("Input media type must be 'audio', got {$this->type}");
		}
		foreach ($this->captionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All caption entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InlineQueryResultAudio
	{
		return new static(
			$array["type"] ?? "audio",
			$array["id"] ?? "",
			$array["audio_url"] ?? "",
			$array["title"] ?? "",
			$array["caption"],
			$array["parse_mode"],
			$array["caption_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["caption_entities"]) : [],
			$array["performer"],
			$array["audio_duration"],
			$array["reply_markup"] ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["input_message_content"] ? InputMessageContent::fromArray($array["input_message_content"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"audio_url" => $this->audioUrl,
			"title" => $this->title,
		];

		if (isset($this->caption)) {
			$array["caption"] = $this->caption;
		}
		if (isset($this->parseMode)) {
			$array["parse_mode"] = $this->parseMode;
		}
		if ($this->captionEntities) {
			$array["caption_entities"] = array_map(fn($entity) => $entity->jsonSerialize(), $this->captionEntities);
		}
		if (isset($this->performer)) {
			$array["performer"] = $this->performer;
		}
		if (isset($this->audioDuration)) {
			$array["audio_duration"] = $this->audioDuration;
		}
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
	public function getAudioUrl(): string
	{
		return $this->audioUrl;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function getCaption(): ?string
	{
		return $this->caption;
	}

	/**
	 * @return string|null
	 */
	public function getParseMode(): ?string
	{
		return $this->parseMode;
	}

	/**
	 * @return array
	 */
	public function getCaptionEntities(): array
	{
		return $this->captionEntities;
	}

	/**
	 * @return string|null
	 */
	public function getPerformer(): ?string
	{
		return $this->performer;
	}

	/**
	 * @return int|null
	 */
	public function getAudioDuration(): ?int
	{
		return $this->audioDuration;
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