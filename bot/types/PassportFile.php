<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#passportfile
 */
class PassportFile implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected int $fileSize;
	protected int $fileDate;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		int $fileSize = 0,
		int $fileDate = 0
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->fileSize = $fileSize;
		$this->fileDate = $fileDate;
	}

	public static function fromArray(array $array): PassportFile
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["file_size"] ?? 0,
			$array["file_date"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"file_size" => $this->fileSize,
			"file_date" => $this->fileDate,
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
	public function getFileSize(): int
	{
		return $this->fileSize;
	}

	/**
	 * @return int
	 */
	public function getFileDate(): int
	{
		return $this->fileDate;
	}
}