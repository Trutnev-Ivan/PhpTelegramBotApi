<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrorunspecified
 */
class PassportElementErrorUnspecified implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	protected string $elementHash;
	protected string $message;

	public function __construct(
		string $source = "unspecified",
		string $type = "",
		string $elementHash = "",
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->elementHash = $elementHash;
		$this->message = $message;

		if ($this->source != "unspecified") {
			throw new \InvalidArgumentException("Source must be 'unspecified', got '{$this->source}'");
		}
	}

	public static function fromArray(array $array): PassportElementErrorUnspecified
	{
		return new static(
			$array["source"] ?? "unspecified",
			$array["type"] ?? "",
			$array["element_hash"] ?? "",
			$array["message"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"source" => $this->source,
			"type" => $this->type,
			"element_hash" => $this->elementHash,
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
	public function getElementHash(): string
	{
		return $this->elementHash;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}