<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportelementerrordatafield
 */
class PassportElementErrorDataField implements \JsonSerializable
{
	protected string $source;
	protected string $type;
	protected string $fieldName;
	protected string $dataHash;
	protected string $message;

	public function __construct(
		string $source = "data",
		string $type = "",
		string $fieldName = "",
		string $dataHash = "",
		string $message = ""
	)
	{
		$this->source = $source;
		$this->type = $type;
		$this->fieldName = $fieldName;
		$this->dataHash = $dataHash;
		$this->message = $message;

		if ($this->source != "data") {
			throw new \InvalidArgumentException("Source must be 'data', got {$this->type}");
		}
	}

	public static function fromArray(array $array): PassportElementErrorDataField
	{
		return new static(
			$array["source"] ?? "data",
			$array["type"] ?? "",
			$array["field_name"] ?? "",
			$array["data_hash"] ?? "",
			$array["message"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"source" => $this->source,
			"type" => $this->type,
			"field_name" => $this->fieldName,
			"data_hash" => $this->dataHash,
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
	public function getFieldName(): string
	{
		return $this->fieldName;
	}

	/**
	 * @return string
	 */
	public function getDataHash(): string
	{
		return $this->dataHash;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}
}