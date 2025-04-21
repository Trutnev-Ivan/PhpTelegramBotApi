<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#document
 */
class Document implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected ?PhotoSize $thumbnail;
	protected ?string $fileName;
	protected ?string $mimeType;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		?PhotoSize $thumbnail = null,
		string $fileName = "",
		string $mimeType = "",
		?int $fileSize = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->thumbnail = $thumbnail;
		$this->fileName = $fileName;
		$this->mimeType = $mimeType;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): Document
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			isset($array["thumbnail"]) ? PhotoSize::fromArray($array["thumbnail"]) : null,
			$array["file_name"] ?? "",
			$array["mime_type"] ?? "",
			$array["file_size"],
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
		];

		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail->jsonSerialize();
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
	 * @return PhotoSize|null
	 */
	public function getThumbnail(): ?PhotoSize
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