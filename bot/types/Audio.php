<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#audio
 */
class Audio implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $duration;
	protected ?string $performer;
	protected ?string $title;
	protected ?string $fileName;
	protected ?string $mimeType;
	protected ?int $fileSize;
	protected ?PhotoSize $thumbnail;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $duration = 0,
		?string $performer = null,
		?string $title = null,
		?string $fileName = null,
		?string $mimeType = null,
		?int $fileSize = null,
		?PhotoSize $thumbnail = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->duration = $duration;
		$this->performer = $performer;
		$this->title = $title;
		$this->fileName = $fileName;
		$this->mimeType = $mimeType;
		$this->fileSize = $fileSize;
		$this->thumbnail = $thumbnail;
	}

	public static function fromArray(array $array): Audio
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["duration"] ?? 0,
			$array["performer"] ?? null,
			$array["title"] ?? null,
			$array["file_name"] ?? null,
			$array["mime_type"] ?? null,
			$array["file_size"] ?? null,
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"duration" => $this->duration,
			"performer" => $this->performer,
			"title" => $this->title,
			"file_name" => $this->fileName,
			"mime_type" => $this->mimeType,
			"file_size" => $this->fileSize,
			"thumbnail" => $this->thumbnail ? $this->thumbnail->jsonSerialize() : null,
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
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @return string|null
	 */
	public function getPerformer(): ?string
	{
		return $this->performer;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @return string|null
	 */
	public function getFileName(): ?string
	{
		return $this->fileName;
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

	/**
	 * @return PhotoSize|null
	 */
	public function getThumbnail(): ?PhotoSize
	{
		return $this->thumbnail;
	}
}