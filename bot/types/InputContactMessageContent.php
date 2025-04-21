<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputcontactmessagecontent
 */
class InputContactMessageContent implements \JsonSerializable
{
	protected string $phoneNumber;
	protected string $firstName;
	protected ?string $lastName;
	protected ?string $vcard;

	public function __construct(
		string $phoneNumber,
		string $firstName,
		?string $lastName = null,
		?string $vcard = null
	)
	{
		$this->phoneNumber = $phoneNumber;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->vcard = $vcard;
	}

	public static function fromArray(array $array): InputContactMessageContent
	{
		return new static(
			$array["phone_number"] ?? "",
			$array["first_name"] ?? "",
			$array["last_name"],
			$array["vcard"]
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"phone_number" => $this->phoneNumber,
			"first_name" => $this->firstName,
			"last_name" => $this->lastName,
			"vcard" => $this->vcard,
		];
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
	 * @return string|null
	 */
	public function getVcard(): ?string
	{
		return $this->vcard;
	}
}