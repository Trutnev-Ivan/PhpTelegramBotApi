<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#animation
 */
class Animation implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $width;
	protected int $height;
	protected int $duration;
	protected PhotoSize $thumbnail;
	protected ?string $fileName;
	protected ?string $mimeType;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $width = 0,
		int $height = 0,
		int $duration = 0,
		PhotoSize $thumbnail = null,
		?string $fileName = null,
		?string $mimeType = null,
		?int $fileSize = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;
		$this->thumbnail = $thumbnail;
		$this->fileName = $fileName;
		$this->mimeType = $mimeType;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): Animation
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["width"] ?? 0,
			$array["height"] ?? 0,
			$array["duration"] ?? 0,
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null,
			$array["file_name"] ?? null,
			$array["mime_type"] ?? null,
			$array["file_size"] ?? null
		);
	}

	public function jsonSerialize()
	{
		return [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"width" => $this->width,
			"height" => $this->height,
			"duration" => $this->duration,
			"thumbnail" => $this->thumbnail ? $this->thumbnail->jsonSerialize() : null,
			"file_name" => $this->fileName,
			"mime_type" => $this->mimeType,
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
	public function getWidth(): int
	{
		return $this->width;
	}

	/**
	 * @return int
	 */
	public function getHeight(): int
	{
		return $this->height;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @return PhotoSize
	 */
	public function getThumbnail(): PhotoSize
	{
		return $this->thumbnail;
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
}