<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrortranslationfiles
 */
class PassportElementErrorTranslationFiles implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	/**
	 * @var string[]
	 */
	protected array $fileHashes;
	protected string $message;

	public function __construct(
		string $source = "translation_files",
		string $type = "",
		array $fileHashes = [],
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fileHashes = $fileHashes;
		$this->message = $message;

		if ($this->source != "translation_files") {
			throw new \InvalidArgumentException("Invalid source for PassportElementErrorTranslationFiles. Expected 'translation_files', got '{$this->source}'");
		}

		foreach ($this->fileHashes as $fileHash) {
			if (!is_string($fileHash)) {
				throw new \InvalidArgumentException("Invalid fileHash for PassportElementErrorTranslationFiles. Expected string, got '" . gettype($fileHash) . "'");
			}
		}
	}

	public static function fromArray(array $array): PassportElementErrorTranslationFiles
	{
		return new static(
			$array["source"] ?? "translation_files",
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
	 * @param string $type
	 * @return PassportElementErrorTranslationFiles
	 */
	public function setType(string $type): PassportElementErrorTranslationFiles
	{
		$this->type = $type;

		return $this;
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