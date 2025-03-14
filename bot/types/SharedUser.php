<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#shareduser
 */
class SharedUser implements \JsonSerializable
{
	protected int $userId;
	protected ?string $firstName;
	protected ?string $lastName;
	protected ?string $username;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;

	public function __construct(
		int $userId = 0,
		?string $firstName = null,
		?string $lastName = null,
		?string $username = null,
		array $photo = []
	)
	{
		$this->userId = $userId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->username = $username;
		$this->photo = $photo;

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("Photo must be an instance of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): SharedUser
	{
		return new static(
			$array["user_id"] ?? 0,
			$array["first_name"],
			$array["last_name"],
			$array["username"],
			array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photo"] ?? [])
		);
	}

	public function jsonSerialize()
	{
		return [
			"user_id" => $this->userId,
			"first_name" => $this->firstName,
			"last_name" => $this->lastName,
			"username" => $this->username,
			"photo" => $this->photo ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photo) : [],
		];
	}

	/**
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->userId;
	}

	/**
	 * @return string|null
	 */
	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @return string|null
	 */
	public function getUsername(): ?string
	{
		return $this->username;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getPhoto(): array
	{
		return $this->photo;
	}
}