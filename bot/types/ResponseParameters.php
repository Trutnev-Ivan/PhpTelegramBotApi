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

	public function jsonSerialize()
	{
		return [
			"migrate_to_chat_id" => $this->migrateToChatId,
			"retry_after" => $this->retryAfter,
		];
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