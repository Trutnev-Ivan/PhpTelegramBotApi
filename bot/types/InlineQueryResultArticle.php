<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 */
class InlineQueryResultArticle implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $title;
	protected InputTextMessageContent|InputLocationMessageContent|InputVenueMessageContent|InputContactMessageContent|InputInvoiceMessageContent $inputMessageContent;
	protected ?InlineKeyboardMarkup $replyMarkup;
	protected ?string $url;
	protected ?string $description;
	protected ?string $thumbnailUrl;
	protected ?int $thumbnailWidth;
	protected ?int $thumbnailHeight;

	public function __construct(
		string $type = "article",
		string $id = "",
		string $title = "",
		InputTextMessageContent|InputLocationMessageContent|InputVenueMessageContent|InputContactMessageContent|InputInvoiceMessageContent $inputMessageContent = null,
		?InlineKeyboardMarkup $replyMarkup = null,
		?string $url = null,
		?string $description = null,
		?string $thumbnailUrl = null,
		?int $thumbnailWidth = null,
		?int $thumbnailHeight = null
	)
	{
		$this->type = $type;
		$this->id = $id;
		$this->title = $title;
		$this->inputMessageContent = $inputMessageContent;
		$this->replyMarkup = $replyMarkup;
		$this->url = $url;
		$this->description = $description;
		$this->thumbnailUrl = $thumbnailUrl;
		$this->thumbnailWidth = $thumbnailWidth;
		$this->thumbnailHeight = $thumbnailHeight;

		if ($this->type != "article") {
			throw new \InvalidArgumentException("Type must be 'article'");
		}
	}

	public static function fromArray(array $array): InlineQueryResultArticle
	{
		return new static(
			$array["type"] ?? "article",
			$array["id"] ?? "",
			$array["title"] ?? "",
			InputMessageContent::fromArray($array["input_message_content"]),
			isset($array["reply_markup"]) ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null,
			$array["url"],
			$array["description"],
			$array["thumbnail_url"],
			$array["thumbnail_width"],
			$array["thumbnail_height"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"title" => $this->title,
			"input_message_content" => $this->inputMessageContent->jsonSerialize(),
		];

		if (isset($this->replyMarkup)) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}
		if (isset($this->url)) {
			$array["url"] = $this->url;
		}
		if (isset($this->description)) {
			$array["description"] = $this->description;
		}
		if (isset($this->thumbnailUrl)) {
			$array["thumbnail_url"] = $this->thumbnailUrl;
		}
		if (isset($this->thumbnailWidth)) {
			$array["thumbnail_width"] = $this->thumbnailWidth;
		}
		if (isset($this->thumbnailHeight)) {
			$array["thumbnail_height"] = $this->thumbnailHeight;
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
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return InputContactMessageContent|InputInvoiceMessageContent|InputLocationMessageContent|InputTextMessageContent|InputVenueMessageContent
	 */
	public function getInputMessageContent(): InputTextMessageContent|InputContactMessageContent|InputVenueMessageContent|InputInvoiceMessageContent|InputLocationMessageContent
	{
		return $this->inputMessageContent;
	}

	/**
	 * @return InlineKeyboardMarkup|null
	 */
	public function getReplyMarkup(): ?InlineKeyboardMarkup
	{
		return $this->replyMarkup;
	}

	/**
	 * @return string|null
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @return string|null
	 */
	public function getThumbnailUrl(): ?string
	{
		return $this->thumbnailUrl;
	}

	/**
	 * @return int|null
	 */
	public function getThumbnailWidth(): ?int
	{
		return $this->thumbnailWidth;
	}

	/**
	 * @return int|null
	 */
	public function getThumbnailHeight(): ?int
	{
		return $this->thumbnailHeight;
	}
}