<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputfile
 */
class InputFile implements \JsonSerializable
{
	protected string $path;
	protected string $mimeType;
	protected string $postName;

	public function __construct(
		string $path = "",
		string $mimeType = "",
		string $postName = ""
	)
	{
		$this->path = $path;
		$this->mimeType = $mimeType;
		$this->postName = $postName;
	}

	public static function fromArray(array $array): InputFile
	{
		return new static(
			$array["path"] ?? "",
			$array["mime_type"] ?? "",
			$array["post_name"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"path" => $this->path,
			"mime_type" => $this->mimeType,
			"post_name" => $this->postName,
		];
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getMimeType(): string
	{
		return $this->mimeType;
	}

	/**
	 * @return string
	 */
	public function getPostName(): string
	{
		return $this->postName;
	}
}