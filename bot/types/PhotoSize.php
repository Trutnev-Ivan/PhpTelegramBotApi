<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#photosize
 */
class PhotoSize implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $width;
	protected int $height;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $width = 0,
		int $height = 0,
		?int $fileSize = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->width = $width;
		$this->height = $height;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): PhotoSize
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["width"] ?? 0,
			$array["height"] ?? 0,
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
	 * @return int|null
	 */
	public function getFileSize(): ?int
	{
		return $this->fileSize;
	}
}