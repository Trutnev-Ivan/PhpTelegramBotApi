<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#videonote
 */
class VideoNote implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $length;
	protected int $duration;
	protected ?PhotoSize $thumbnail;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $length = 0,
		int $duration = 0,
		?PhotoSize $thumbnail = null,
		?int $fileSize = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->length = $length;
		$this->duration = $duration;
		$this->thumbnail = $thumbnail;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): VideoNote
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["length"] ?? 0,
			$array["duration"] ?? 0,
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null,
			$array["file_size"] 
		);
	}

	public function jsonSerialize()
	{
		return [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"length" => $this->length,
			"duration" => $this->duration,
			"thumbnail" => $this->thumbnail ? $this->thumbnail->jsonSerialize() : null,
			"file_size" => $this->fileSize,
		];
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
	public function getLength(): int
	{
		return $this->length;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @return PhotoSize|null
	 */
	public function getThumbnail(): ?PhotoSize
	{
		return $this->thumbnail;
	}

	/**
	 * @return int|null
	 */
	public function getFileSize(): ?int
	{
		return $this->fileSize;
	}
}
