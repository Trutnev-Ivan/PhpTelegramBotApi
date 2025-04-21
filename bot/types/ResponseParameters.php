<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#responseparameters
 */
class ResponseParameters implements \JsonSerializable
{
	protected ?int $migrateToChatId;
	protected ?int $retryAfter;

	public function __construct(
		?int $migrateToChatId = null,
		?int $retryAfter = null
	)
	{
		$this->migrateToChatId = $migrateToChatId;
		$this->retryAfter = $retryAfter;
	}

	public static function fromArray(array $array): ResponseParameters
	{
		return new static(
			$array["migrate_to_chat_id"],
			$array["retry_after"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [];

		if (isset($this->migrateToChatId)){
			$array["migrate_to_chat_id"] = $this->migrateToChatId;
		}
		if (isset($this->retryAfter)){
			$array["retry_after"] = $this->retryAfter;
		}

		return $array;
	}

	/**
	 * @return int|null
	 */
	public function getMigrateToChatId(): ?int
	{
		return $this->migrateToChatId;
	}

	/**
	 * @return int|null
	 */
	public function getRetryAfter(): ?int
	{
		return $this->retryAfter;
	}
}