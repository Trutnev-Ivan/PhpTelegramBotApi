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
			$array["performer"],
			$array["title"],
			$array["file_name"],
			$array["mime_type"],
			$array["file_size"],
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"duration" => $this->duration,
		];

		if (isset($this->performer)) {
			$array["performer"] = $this->performer;
		}
		if (isset($this->title)) {
			$array["title"] = $this->title;
		}
		if (isset($this->fileName)) {
			$array["file_name"] = $this->fileName;
		}
		if (isset($this->mimeType)) {
			$array["mime_type"] = $this->mimeType;
		}
		if (isset($this->fileSize)) {
			$array["file_size"] = $this->fileSize;
		}
		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail->jsonSerialize();
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