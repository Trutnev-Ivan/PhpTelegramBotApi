<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequery
 */
class InlineQuery implements \JsonSerializable
{
	protected string $id;
	protected User $from;
	protected string $query;
	protected string $offset;
	protected ?string $chatType;
	protected ?Location $location;

	public function __construct(
		string $id = "",
		User $from = null,
		string $query = "",
		string $offset = "",
		?string $chatType = null,
		?Location $location = null,
	)
	{
		$this->id = $id;
		$this->from = $from;
		$this->query = $query;
		$this->offset = $offset;
		$this->chatType = $chatType;
		$this->location = $location;
	}

	public static function fromArray(array $array): InlineQuery
	{
		return new static(
			$array["id"] ?? "",
			User::fromArray($array["from"]),
			$array["query"] ?? "",
			$array["offset"] ?? "",
			$array["chat_type"],
			$array["location"] ? Location::fromArray($array["location"]) : null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"from" => $this->from ? $this->from->jsonSerialize() : null,
			"query" => $this->query,
			"offset" => $this->offset,
		];

		if (isset($this->chatType)) {
			$array["chat_type"] = $this->chatType;
		}
		if (isset($this->location)) {
			$array["location"] = $this->location->jsonSerialize();
		}

		return $array;
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
	 * @return string
	 */
	public function getQuery(): string
	{
		return $this->query;
	}

	/**
	 * @return string
	 */
	public function getOffset(): string
	{
		return $this->offset;
	}

	/**
	 * @return string|null
	 */
	public function getChatType(): ?string
	{
		return $this->chatType;
	}

	/**
	 * @return Location|null
	 */
	public function getLocation(): ?Location
	{
		return $this->location;
	}
}