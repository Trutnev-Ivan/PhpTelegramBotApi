<?php namespace Telegram\Bot\Types;

class PassportElementErrorTranslationFile implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	protected string $fileHash;
	protected string $message;

	public function __construct(
		string $source = "translation_file",
		string $type = "",
		string $fileHash = "",
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fileHash = $fileHash;
		$this->message = $message;

		if ($this->source != "translation_file") {
			throw new \InvalidArgumentException("Invalid source: '{$this->source}'. Only 'translation_file' is allowed.");
		}
	}

	public static function fromArray(array $array): PassportElementErrorTranslationFile
	{
		return new static(
			$array["source"] ?? "translation_file",
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