<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputpaidmediavideo
 */
class InputPaidMediaVideo implements \JsonSerializable
{
	protected string $type;
	protected string $media;
	protected ?string $thumbnail;
	protected ?string $cover;
	protected ?int $startTimestamp;
	protected ?int $width;
	protected ?int $height;
	protected ?int $duration;
	protected bool $supportsStreaming;

	public function __construct(
		string $type = "video",
		string $media = "",
		?string $thumbnail = null,
		?string $cover = null,
		?int $startTimestamp = null,
		?int $width = null,
		?int $height = null,
		?int $duration = null,
		bool $supportsStreaming = false
	)
	{
		$this->type = $type;
		$this->media = $media;
		$this->thumbnail = $thumbnail;
		$this->cover = $cover;
		$this->startTimestamp = $startTimestamp;
		$this->width = $width;
		$this->height = $height;
		$this->duration = $duration;
		$this->supportsStreaming = $supportsStreaming;

		if ($this->type != "video"){
			throw new \InvalidArgumentException("Type must be 'video', got {$this->type}");
		}
	}

	public static function fromArray(array $array): InputPaidMediaVideo
	{
		return new static(
			$array["type"] ?? "video",
			$array["media"] ?? "",
			$array["thumbnail"],
			$array["cover"],
			$array["start_timestamp"],
			$array["width"],
			$array["height"],
			$array["duration"],
			$array["supports_streaming"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"media" => $this->media,
		];

		if (isset($this->thumbnail)){
			$array["thumbnail"] = $this->thumbnail;
		}
		if (isset($this->cover)){
			$array["cover"] = $this->cover;
		}
		if (isset($this->startTimestamp)){
			$array["start_timestamp"] = $this->startTimestamp;
		}
		if (isset($this->width)){
			$array["width"] = $this->width;
		}
		if (isset($this->height)){
            $array["height"] = $this->height;
        }
		if (isset($this->duration)){
            $array["duration"] = $this->duration;
        }
		if (isset($this->supportsStreaming)){
			$array["supports_streaming"] = $this->supportsStreaming;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getMedia(): string
	{
		return $this->media;
	}

	/**
	 * @return string|null
	 */
	public function getThumbnail(): ?string
	{
		return $this->thumbnail;
	}

	/**
	 * @return string|null
	 */
	public function getCover(): ?string
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
	 * @return int|null
	 */
	public function getWidth(): ?int
	{
		return $this->width;
	}

	/**
	 * @return int|null
	 */
	public function getHeight(): ?int
	{
		return $this->height;
	}

	/**
	 * @return int|null
	 */
	public function getDuration(): ?int
	{
		return $this->duration;
	}

	/**
	 * @return bool
	 */
	public function isSupportsStreaming(): bool
	{
		return $this->supportsStreaming;
	}
}