<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#choseninlineresult
 */
class ChosenInlineResult implements \JsonSerializable
{
	protected string $resultId;
	protected User $from;
	protected ?Location $location;
	protected ?string $inlineMessageId;
	protected string $query;

	public function __construct(
		string $resultId = "",
		User $from = null,
		?Location $location = null,
		?string $inlineMessageId = null,
		string $query = ""
	)
	{
		$this->resultId = $resultId;
		$this->from = $from;
		$this->location = $location;
		$this->inlineMessageId = $inlineMessageId;
		$this->query = $query;
	}

	public static function fromArray(array $array): ChosenInlineResult
	{
		return new static(
			$array["result_id"] ?? "",
			$array["from"] ? User::fromArray($array["from"]) : null,
			$array["location"] ? Location::fromArray($array["location"]) : null,
			$array["inline_message_id"],
			$array["query"] ?? ""
		);
	}

	public function jsonSerialize(): mixed
	{
		return [
			"result_id" => $this->resultId,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"location" => $this->location ? $this->location->jsonSerialize() : null,
			"inline_message_id" => $this->inlineMessageId,
			"query" => $this->query,
		];
	}

	/**
	 * @return string
	 */
	public function getResultId(): string
	{
		return $this->resultId;
	}

	/**
	 * @return User
	 */
	public function getFrom(): User
	{
		return $this->from;
	}

	/**
	 * @return Location|null
	 */
	public function getLocation(): ?Location
	{
		return $this->location;
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
	public function getQuery(): string
	{
		return $this->query;
	}
}