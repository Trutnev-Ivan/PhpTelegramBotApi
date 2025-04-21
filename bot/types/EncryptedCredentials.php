<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#encryptedcredentials
 */
class EncryptedCredentials implements \JsonSerializable
{
	protected string $data;
	protected string $hash;
	protected string $secret;

	public function __construct(
		string $data = "",
		string $hash = "",
		string $secret = ""
	)
	{
		$this->data = $data;
		$this->hash = $hash;
		$this->secret = $secret;
	}

	public static function fromArray(array $array): EncryptedCredentials
	{
		return new static(
			$array["data"] ?? "",
			$array["hash"] ?? "",
			$array["secret"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"data" => $this->data,
			"hash" => $this->hash,
			"secret" => $this->secret,
		];
	}

	/**
	 * @return string
	 */
	public function getData(): string
	{
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getHash(): string
	{
		return $this->hash;
	}

	/**
	 * @return string
	 */
	public function getSecret(): string
	{
		return $this->secret;
	}
}