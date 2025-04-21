<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputtextmessagecontent
 */
class InputTextMessageContent implements \JsonSerializable
{
	protected string $messageText;
	protected ?string $parseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $entities;
	protected ?LinkPreviewOptions $linkPreviewOptions;

	public function __construct(
		string $messageText = "",
		?string $parseMode = null,
		array $entities = [],
		?LinkPreviewOptions $linkPreviewOptions = null
	)
	{
		$this->messageText = $messageText;
		$this->parseMode = $parseMode;
		$this->entities = $entities;
		$this->linkPreviewOptions = $linkPreviewOptions;

		foreach ($this->entities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): InputTextMessageContent
	{
		return new static(
			$array["message_text"] ?? "",
			$array["parse_mode"] ?? null,
			$array["entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["entities"]) : [],
			$array["link_preview_options"] ? LinkPreviewOptions::fromArray($array["link_preview_options"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"message_text" => $this->messageText,
			"entities" => array_map(fn($entity) => $entity->jsonSerialize(), $this->entities),
		];

		if (isset($this->parseMode)) {
			$array["parse_mode"] = $this->parseMode;
		}
		if (isset($this->linkPreviewOptions)) {
			$array["link_preview_options"] = $this->linkPreviewOptions->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getMessageText(): string
	{
		return $this->messageText;
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
	public function getEntities(): array
	{
		return $this->entities;
	}

	/**
	 * @return LinkPreviewOptions|null
	 */
	public function getLinkPreviewOptions(): ?LinkPreviewOptions
	{
		return $this->linkPreviewOptions;
	}
}