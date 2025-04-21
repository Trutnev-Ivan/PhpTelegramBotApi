<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#contact
 */
class Contact implements \JsonSerializable
{
	protected string $phoneNumber;
	protected string $firstName;
	protected ?string $lastName;
	protected ?int $userId;
	protected ?string $vcard;

	public function __construct(
		string $phoneNumber,
		string $firstName,
		?string $lastName = null,
		?int $userId = null,
		?string $vcard = null
	)
	{
		$this->phoneNumber = $phoneNumber;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->userId = $userId;
		$this->vcard = $vcard;
	}

	public static function fromArray(array $array): Contact
	{
		return new Contact(
			$array["phone_number"] ?? "",
			$array["first_name"] ?? "",
			$array["last_name"] ?? null,
			$array["user_id"] ?? null,
			$array["vcard"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"phone_number" => $this->phoneNumber,
			"first_name" => $this->firstName,
		];

		if (isset($this->lastName)) {
			$array["last_name"] = $this->lastName;
		}
		if (isset($this->userId)) {
			$array["user_id"] = $this->userId;
		}
		if (isset($this->vcard)) {
			$array["vcard"] = $this->vcard;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getPhoneNumber(): string
	{
		return $this->phoneNumber;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
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
	 * @return int|null
	 */
	public function getUserId(): ?int
	{
		return $this->userId;
	}

	/**
	 * @return string|null
	 */
	public function getVcard(): ?string
	{
		return $this->vcard;
	}
}