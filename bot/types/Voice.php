<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#voice
 */
class Voice implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $duration;
	protected ?string $mimeType;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $duration = 0,
		?string $mimeType = null,
		?int $fileSize = null,
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->duration = $duration;
		$this->mimeType = $mimeType;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): Voice
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["duration"] ?? 0,
			$array["mime_type"] ?? null,
			$array["file_size"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"duration" => $this->duration,
		];

		if (isset($this->mimeType)) {
			$array["mime_type"] = $this->mimeType;
		}
		if (isset($this->fileSize)) {
			$array["file_size"] = $this->fileSize;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getFileId(): string
	{
		return $this->fileId;
	}

	/**
	 * @return string
	 */
	public function getFileUniqueId(): string
	{
		return $this->fileUniqueId;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @return string|null
	 */
	public function getMimeType(): ?string
	{
		return $this->mimeType;
	}

	/**
	 * @return int|null
	 */
	public function getFileSize(): ?int
	{
		return $this->fileSize;
	}
}