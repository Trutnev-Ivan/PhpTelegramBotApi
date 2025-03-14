<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatphoto
 */
class ChatPhoto implements \JsonSerializable
{
	protected string $smallFileId;
	protected string $smallFileUniqueId;
	protected string $bigFileId;
	protected string $bigFileUniqueId;

	public function __construct(
		string $smallFileId = "",
		string $smallFileUniqueId = "",
		string $bigFileId = "",
		string $bigFileUniqueId = ""
	)
	{
		$this->smallFileId = $smallFileId;
		$this->smallFileUniqueId = $smallFileUniqueId;
		$this->bigFileId = $bigFileId;
		$this->bigFileUniqueId = $bigFileUniqueId;
	}

	public static function fromArray(array $array): Chatphoto
	{
		return new static(
			$array["small_file_id"] ?? "",
			$array["small_file_unique_id"] ?? "",
			$array["big_file_id"] ?? "",
			$array["big_file_unique_id"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"small_file_id" => $this->smallFileId,
			"small_file_unique_id" => $this->smallFileUniqueId,
			"big_file_id" => $this->bigFileId,
			"big_file_unique_id" => $this->bigFileUniqueId,
		];
	}

	/**
	 * @return string
	 */
	public function getSmallFileId(): string
	{
		return $this->smallFileId;
	}

	/**
	 * @return string
	 */
	public function getSmallFileUniqueId(): string
	{
		return $this->smallFileUniqueId;
	}

	/**
	 * @return string
	 */
	public function getBigFileId(): string
	{
		return $this->bigFileId;
	}

	/**
	 * @return string
	 */
	public function getBigFileUniqueId(): string
	{
		return $this->bigFileUniqueId;
	}
}