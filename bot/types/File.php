<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#file
 */
class File implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected ?int $fileSize;
	protected ?string $filePath;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		?int $fileSize = null,
		?string $filePath = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->fileSize = $fileSize;
		$this->filePath = $filePath;
	}

	public static function fromArray(array $array): File
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["file_size"],
			$array["file_path"]
		);
	}

	public function jsonSerialize()
	{
		return [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"file_size" => $this->fileSize,
			"file_path" => $this->filePath,
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
	 * @return int|null
	 */
	public function getFileSize(): ?int
	{
		return $this->fileSize;
	}

	/**
	 * @return string|null
	 */
	public function getFilePath(): ?string
	{
		return $this->filePath;
	}
}