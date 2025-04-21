<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrorreverseside
 */
class PassportElementErrorReverseSide implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	protected string $fileHash;
	protected string $message;

	public function __construct(
		string $source = "reverse_side",
		string $type = "",
		string $fileHash = "",
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fileHash = $fileHash;
		$this->message = $message;

		if ($this->source != "reverse_side") {
			throw new \InvalidArgumentException("Invalid source: " . $this->source . " must be 'reverse_side'");
		}
	}

	public static function fromArray(array $array): PassportElementErrorReverseSide
	{
		return new static(
			$array["source"] ?? "reverse_side",
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