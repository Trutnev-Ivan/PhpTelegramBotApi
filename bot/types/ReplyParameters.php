<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#replyparameters
 */
class ReplyParameters implements \JsonSerializable
{
	protected int $messageId;
	protected int|string|null $chatId;
	protected bool $allowSendingWithoutReply;
	protected ?string $quote;
	protected ?string $quoteParseMode;
	/**
	 * @var MessageEntity[]
	 */
	protected array $quoteEntities;
	protected ?int $quotePosition;

	public function __construct(
		int $messageId = 0,
		int|string|null $chatId = null,
		bool $allowSendingWithoutReply = false,
		?string $quote = null,
		?string $quoteParseMode = null,
		array $quoteEntities = [],
		?int $quotePosition = null
	)
	{
		$this->messageId = $messageId;
		$this->chatId = $chatId;
		$this->allowSendingWithoutReply = $allowSendingWithoutReply;
		$this->quote = $quote;
		$this->quoteParseMode = $quoteParseMode;
		$this->quoteEntities = $quoteEntities;
		$this->quotePosition = $quotePosition;

		foreach ($this->quoteEntities as $entity){
			if (!$entity instanceof MessageEntity){
				throw new \InvalidArgumentException("All entities must be instances of ".MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): ReplyParameters
	{
		return new static(
			$array["message_id"] ?? null,
			$array["chat_id"] ?? null,
			$array["allow_sending_without_reply"] ?? null,
			$array["quote"] ?? null,
			$array["quote_parse_mode"] ?? null,
			$array["quote_entities"] ?? null,
			$array["quote_position"] ?? null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"message_id" => $this->messageId,
			"allow_sending_without_reply" => $this->allowSendingWithoutReply,
			"quote_entities" => $this->quoteEntities ? array_map(fn ($entity) => $entity->jsonSerialize(), $this->quoteEntities) : [],
		];

		if (isset($this->chatId)){
			$array["chat_id"] = $this->chatId;
		}
		if (isset($this->quote)){
			$array["quote"] = $this->quote;
		}
		if (isset($this->quoteParseMode)){
			$array["quote_parse_mode"] = $this->quoteParseMode;
		}
		if (isset($this->quotePosition)){
			$array["quote_position"] = $this->quotePosition;
		}

		return $array;
	}

	/**
	 * @return int
	 */
	public function getMessageId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return int|string|null
	 */
	public function getChatId(): int|string|null
	{
		return $this->chatId;
	}

	/**
	 * @return bool
	 */
	public function isAllowSendingWithoutReply(): bool
	{
		return $this->allowSendingWithoutReply;
	}

	/**
	 * @return string|null
	 */
	public function getQuote(): ?string
	{
		return $this->quote;
	}

	/**
	 * @return string|null
	 */
	public function getQuoteParseMode(): ?string
	{
		return $this->quoteParseMode;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getQuoteEntities(): array
	{
		return $this->quoteEntities;
	}

	/**
	 * @return int|null
	 */
	public function getQuotePosition(): ?int
	{
		return $this->quotePosition;
	}
}