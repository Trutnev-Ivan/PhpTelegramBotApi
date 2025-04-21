<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#video
 */
class Video implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $width;
	protected int $height;
	protected int $duration;
	protected ?PhotoSize $thumbnail;
	/**
	 * @var PhotoSize[]
	 */
	protected array $cover;
	protected ?int $startTimestamp;
	protected ?string $fileName;
	protected ?string $mimeType;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $width = 0,
		int $height = 0,
		int $duration = 0,
		?PhotoSize $thumbnail = null,
		array $cover = [],
		?int $startTimestamp = null,
		?string $fileName = null,
		?string $mimeType = null,
		?int $fileSize = null,
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;
		$this->thumbnail = $thumbnail;
		$this->cover = $cover;
		$this->startTimestamp = $startTimestamp;
		$this->fileName = $fileName;
		$this->mimeType = $mimeType;
		$this->fileSize = $fileSize;

		foreach ($this->cover as $cover) {
			if (!($cover instanceof PhotoSize)) {
				throw new \InvalidArgumentException("All elements of the 'cover' array must be instances of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): Video
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["width"] ?? 0,
			$array["height"] ?? 0,
			$array["duration"] ?? 0,
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null,
			$array["cover"] ? array_map(fn($cover) => PhotoSize::fromArray($cover), $array["cover"]) : [],
			$array["start_timestamp"] ?? null,
			$array["file_name"] ?? null,
			$array["mime_type"] ?? null,
			$array["file_size"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"width" => $this->width,
			"height" => $this->height,
			"duration" => $this->duration,
			"cover" => $this->cover ? array_map(fn($cover) => $cover->jsonSerialize(), $this->cover) : [],
		];

		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail->jsonSerialize();
		}
		if (isset($this->startTimestamp)) {
			$array["start_timestamp"] = $this->startTimestamp;
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
	 * @return PhotoSize|null
	 */
	public function getThumbnail(): ?PhotoSize
	{
		return $this->thumbnail;
	}

	/**
	 * @return array
	 */
	public function getCover(): array
	{
		return $this->cover;
	}

	/**
	 * @return int|null
	 */
	public function getStartTimestamp(): ?int
	{
		return $this->startTimestamp;
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