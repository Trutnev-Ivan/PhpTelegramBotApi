<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#stickerset
 */
class StickerSet implements \JsonSerializable
{
	protected string $name;
	protected string $title;
	protected string $stickerType;
	/**
	 * @var Sticker[]
	 */
	protected array $stickers;
	protected ?PhotoSize $thumbnail;

	public function __construct(
		string $name = "",
		string $title = "",
		string $stickerType = "",
		array $stickers = [],
		?PhotoSize $thumbnail = null
	)
	{
		$this->name = $name;
		$this->title = $title;
		$this->stickerType = $stickerType;
		$this->stickers = $stickers;
		$this->thumbnail = $thumbnail;

		foreach ($this->stickers as $sticker) {
			if (!$sticker instanceof Sticker) {
				throw new \InvalidArgumentException("stickers must be an array of " . Sticker::class);
			}
		}
	}

	public static function fromArray(array $array): StickerSet
	{
		return new static(
			$array["name"] ?? "",
			$array["title"] ?? "",
			$array["sticker_type"] ?? "",
			$array["stickers"] ? array_map(fn($sticker) => Sticker::fromArray($sticker), $array["stickers"]) : [],
			$array["thumbnail"] ? PhotoSize::fromArray($array["thumbnail"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"name" => $this->name,
			"title" => $this->title,
			"sticker_type" => $this->stickerType,
		];

		if ($this->stickers) {
			$array["stickers"] = array_map(fn(Sticker $sticker) => $sticker->jsonSerialize(), $this->stickers);
		}
		if (isset($this->thumbnail)) {
			$array["thumbnail"] = $this->thumbnail->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getStickerType(): string
	{
		return $this->stickerType;
	}

	/**
	 * @return Sticker[]
	 */
	public function getStickers(): array
	{
		return $this->stickers;
	}

	/**
	 * @return PhotoSize|null
	 */
	public function getThumbnail(): ?PhotoSize
	{
		return $this->thumbnail;
	}
}