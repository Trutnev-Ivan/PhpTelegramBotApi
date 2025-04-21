<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrorselfie
 */
class PassportElementErrorSelfie implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	protected string $fileHash;
	protected string $message;

	public function __construct(
		string $source = "selfie",
		string $type = "",
		string $fileHash = "",
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fileHash = $fileHash;
		$this->message = $message;

		if ($this->source != "selfie") {
			throw new \InvalidArgumentException("Source must be'selfie', got '{$this->source}'");
		}
	}

	public static function fromArray(array $array): PassportElementErrorSelfie
	{
		return new static(
			$array["source"] ?? "selfie",
			$array["type"] ?? "",
			$array["file_hash"] ?? "",
			$array["message"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"source" => $this->source,
			"type" => $this->type,
			"file_hash" => $this->fileHash,
			"message" => $this->message,
		];
	}

	/**
	 * @return string
	 */
	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getFileHash(): string
	{
		return $this->fileHash;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}