<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chat
 */
class Chat implements \JsonSerializable
{
	protected int $id;
	protected string $type;
	protected ?string $title;
	protected ?string $username;
	protected ?string $firstName;
	protected ?string $lastName;
	protected bool $isForum;

	public function __construct(
		int $id = 0,
		string $type = "",
		?string $title = null,
		?string $username = null,
		?string $firstName = null,
		?string $lastName = null,
		bool $isForum = false
	)
	{
		$this->id = $id;
		$this->type = $type;
		$this->title = $title;
		$this->username = $username;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->isForum = $isForum;
	}

	public static function fromArray(array $array): Chat
	{
		return new static(
			$array["id"] ?? 0,
			$array["type"] ?? "",
			$array["title"],
			$array["username"],
			$array["first_name"],
			$array["last_name"],
			$array["is_forum"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"type" => $this->type,
			"is_forum" => $this->isForum,
		];

		if (isset($this->title)) {
			$array["title"] = $this->title;
		}
		if (isset($this->username)) {
			$array["username"] = $this->username;
		}
		if (isset($this->firstName)) {
			$array["first_name"] = $this->firstName;
		}
		if (isset($this->lastName)) {
			$array["last_name"] = $this->lastName;
		}

		return $array;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function getUsername(): ?string
	{
		return $this->username;
	}

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function isForum(): bool
	{
		return $this->isForum;
	}
}
