<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrorfiles
 */
class PassportElementErrorFiles implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	/**
	 * @var string[]
	 */
	protected array $fileHashes;
	protected string $message;

	public function __construct(
		string $source = "files",
		string $type = "",
		array $fileHashes = [],
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fileHashes = $fileHashes;
		$this->message = $message;

		if ($this->source != "files") {
			throw new \InvalidArgumentException("Source must be 'files', got '{$this->source}'");
		}

		foreach ($this->fileHashes as $fileHash) {
			if (!is_string($fileHash)) {
				throw new \InvalidArgumentException("All file hashes must be strings, got '" . gettype($fileHash) . "'");
			}
		}
	}

	public static function fromArray(array $array): PassportElementErrorFiles
	{
		return new static(
			$array["source"] ?? "files",
			$array["type"] ?? "",
			$array["file_hashes"] ?? [],
			$array["message"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"source" => $this->source,
			"type" => $this->type,
			"file_hashes" => $this->fileHashes,
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
	 * @return string[]
	 */
	public function getFileHashes(): array
	{
		return $this->fileHashes;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}