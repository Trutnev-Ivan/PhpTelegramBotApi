<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#sticker
 */
class Sticker implements \JsonSerializable
{
	protected string $fileId;
	protected string $fileUniqueId;
	protected string $type;
	protected int $width;
	protected int $height;
	protected bool $isAnimated;
	protected bool $isVideo;
	protected ?PhotoSize $thumbnail;
	protected ?string $emoji;
	protected ?string $setName;
	protected ?File $premiumAnimation;
	protected ?MaskPosition $maskPosition;
	protected ?string $customEmojiId;
	protected bool $needsRepainting;
	protected ?int $fileSize;

	public function __construct(
		string $fileId = "",
		string $fileUniqueId = "",
		string $type = "",
		int $width = 0,
		int $height = 0,
		bool $isAnimated = false,
		bool $isVideo = false,
		?PhotoSize $thumbnail = null,
		?string $emoji = null,
		?string $setName = null,
		?File $premiumAnimation = null,
		?MaskPosition $maskPosition = null,
		?string $customEmojiId = null,
		bool $needsRepainting = false,
		?int $fileSize = null
	)
	{
		$this->fileId = $fileId;
		$this->fileUniqueId = $fileUniqueId;
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;
		$this->isAnimated = $isAnimated;
		$this->isVideo = $isVideo;
		$this->thumbnail = $thumbnail;
		$this->emoji = $emoji;
		$this->setName = $setName;
		$this->premiumAnimation = $premiumAnimation;
		$this->maskPosition = $maskPosition;
		$this->customEmojiId = $customEmojiId;
		$this->needsRepainting = $needsRepainting;
		$this->fileSize = $fileSize;
	}

	public static function fromArray(array $array): Sticker
	{
		return new static(
			$array["file_id"] ?? "",
			$array["file_unique_id"] ?? "",
			$array["type"] ?? "",
			$array["width"] ?? 0,
			$array["height"] ?? 0,
			$array["is_animated"] ?? false,
			$array["is_video"] ?? false,
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null,
			$array["emoji"],
			$array["set_name"],
			$array["premium_animation"] ? File::fromArray($array["premium_animation"]) : null,
			$array["mask_position"] ? MaskPosition::fromArray($array["mask_position"]) : null,
			$array["custom_emoji_id"],
			$array["needs_repainting"] ?? false,
			$array["file_size"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"file_id" => $this->fileId,
			"file_unique_id" => $this->fileUniqueId,
			"type" => $this->type,
			"width" => $this->width,
			"height" => $this->height,
			"is_animated" => $this->isAnimated,
			"is_video" => $this->isVideo,
			"needs_repainting" => $this->needsRepainting,
		];

		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail->jsonSerialize();
		}
		if (isset($this->emoji)) {
			$array["emoji"] = $this->emoji;
		}
		if (isset($this->setName)) {
			$array["set_name"] = $this->setName;
		}
		if (isset($this->premiumAnimation)) {
			$array["premium_animation"] = $this->premiumAnimation->jsonSerialize();
		}
		if (isset($this->maskPosition)) {
			$array["mask_position"] = $this->maskPosition->jsonSerialize();
		}
		if (isset($this->customEmojiId)) {
			$array["custom_emoji_id"] = $this->customEmojiId;
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
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
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
	 * @return bool
	 */
	public function isAnimated(): bool
	{
		return $this->isAnimated;
	}

	/**
	 * @return bool
	 */
	public function isVideo(): bool
	{
		return $this->isVideo;
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
	public function getEmoji(): ?string
	{
		return $this->emoji;
	}

	/**
	 * @return string|null
	 */
	public function getSetName(): ?string
	{
		return $this->setName;
	}

	/**
	 * @return File|null
	 */
	public function getPremiumAnimation(): ?File
	{
		return $this->premiumAnimation;
	}

	/**
	 * @return MaskPosition|null
	 */
	public function getMaskPosition(): ?MaskPosition
	{
		return $this->maskPosition;
	}

	/**
	 * @return string|null
	 */
	public function getCustomEmojiId(): ?string
	{
		return $this->customEmojiId;
	}

	/**
	 * @return bool
	 */
	public function isNeedsRepainting(): bool
	{
		return $this->needsRepainting;
	}

	/**
	 * @return int|null
	 */
	public function getFileSize(): ?int
	{
		return $this->fileSize;
	}
}