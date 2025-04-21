<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#encryptedpassportelement
 */
class EncryptedPassportElement implements \JsonSerializable
{
	protected string $type;
	protected ?string $data;
	protected ?string $phoneNumber;
	protected ?string $email;
	/**
	 * @var PassportFile[]
	 */
	protected array $files;
	protected ?PassportFile $frontSide;
	protected ?PassportFile $reverseSide;
	protected ?PassportFile $selfie;
	/**
	 * @var PassportFile[]
	 */
	protected array $translation;
	protected string $hash;

	public function __construct(
		string $type = "",
		?string $data = null,
		?string $phoneNumber = null,
		?string $email = null,
		array $files = [],
		?PassportFile $frontSide = null,
		?PassportFile $reverseSide = null,
		?PassportFile $selfie = null,
		array $translation = [],
		string $hash = ""
	)
	{
		$this->type = $type;
		$this->data = $data;
		$this->phoneNumber = $phoneNumber;
		$this->email = $email;
		$this->files = $files;
		$this->frontSide = $frontSide;
		$this->reverseSide = $reverseSide;
		$this->selfie = $selfie;
		$this->translation = $translation;
		$this->hash = $hash;

		foreach ($this->files as $file) {
			if (!$file instanceof PassportFile) {
				throw new \InvalidArgumentException("files must be an array of PassportFile objects");
			}
		}

		foreach ($this->translation as $translation) {
			if (!$translation instanceof PassportFile) {
				throw new \InvalidArgumentException("translation must be an array of PassportFile objects");
			}
		}
	}

	public static function fromArray(array $array): EncryptedPassportElement
	{
		return new static(
			$array["type"] ?? "",
			$array["data"],
			$array["phone_number"],
			$array["email"],
			$array["files"] ? array_map(fn($file) => PassportFile::fromArray($file), $array["files"]) : [],
			$array["front_side"] ? PassportFile::fromArray($array["front_side"]) : null,
			$array["reverse_side"] ? PassportFile::fromArray($array["reverse_side"]) : null,
			$array["selfie"] ? PassportFile::fromArray($array["selfie"]) : null,
			$array["translation"] ? array_map(fn($file) => PassportFile::fromArray($file), $array["translation"]) : [],
			$array["hash"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"hash" => $this->hash,
		];

		if (isset($this->data)) {
			$array["data"] = $this->data;
		}
		if (isset($this->phoneNumber)) {
			$array["phone_number"] = $this->phoneNumber;
		}
		if (isset($this->email)) {
			$array["email"] = $this->email;
		}
		if ($this->files) {
			$array["files"] = array_map(fn($file) => $file->jsonSerialize(), $this->files);
		}
		if (isset($this->frontSide)) {
			$array["front_side"] = $this->frontSide->jsonSerialize();
		}
		if (isset($this->reverseSide)) {
			$array["reverse_side"] = $this->reverseSide->jsonSerialize();
		}
		if (isset($this->selfie)) {
			$array["selfie"] = $this->selfie->jsonSerialize();
		}
		if ($this->translation) {
			$array["translation"] = array_map(fn($file) => $file->jsonSerialize(), $this->translation);
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function getData(): ?string
	{
		return $this->data;
	}

	/**
	 * @return string|null
	 */
	public function getPhoneNumber(): ?string
	{
		return $this->phoneNumber;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @return PassportFile[]
	 */
	public function getFiles(): array
	{
		return $this->files;
	}

	/**
	 * @return PassportFile|null
	 */
	public function getFrontSide(): ?PassportFile
	{
		return $this->frontSide;
	}

	/**
	 * @return PassportFile|null
	 */
	public function getReverseSide(): ?PassportFile
	{
		return $this->reverseSide;
	}

	/**
	 * @return PassportFile|null
	 */
	public function getSelfie(): ?PassportFile
	{
		return $this->selfie;
	}

	/**
	 * @return PassportFile[]
	 */
	public function getTranslation(): array
	{
		return $this->translation;
	}

	/**
	 * @return string
	 */
	public function getHash(): string
	{
		return $this->hash;
	}
}