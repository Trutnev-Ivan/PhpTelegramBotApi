<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inputsticker
 */
class InputSticker implements \JsonSerializable
{
	protected InputFile|string $sticker;
	protected string $format;
	/**
	 * @var string[]
	 */
	protected array $emojiList;
	protected ?MaskPosition $maskPosition;
	/**
	 * @var string[]
	 */
	protected array $keywords;

	public function __construct(
		InputFile|string $sticker,
		string $format = "",
		array $emojiList = [],
		?MaskPosition $maskPosition = null,
		array $keywords = []
	)
	{
		$this->sticker = $sticker;
		$this->format = $format;
		$this->emojiList = $emojiList;
		$this->maskPosition = $maskPosition;
		$this->keywords = $keywords;

		foreach ($this->emojiList as $emoji) {
			if (!is_string($emoji)) {
				throw new \InvalidArgumentException("All emojiList must be strings");
			}
		}

		foreach ($this->keywords as $keyword) {
			if (!is_string($keyword)) {
				throw new \InvalidArgumentException("All keywords must be strings");
			}
		}
	}

	public static function fromArray(array $array): InputSticker
	{
		return new static(
			$array["sticker"] ?? "",
			$array["format"] ?? "",
			$array["emoji_list"] ?? [],
			$array["mask_position"] ? MaskPosition::fromArray($array["mask_position"]) : null,
			$array["keywords"] ?? []
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"sticker" => $this->sticker instanceof InputFile ? $this->sticker->jsonSerialize() : $this->sticker,
			"format" => $this->format,
			"emoji_list" => $this->emojiList,
			"keywords" => $this->keywords,
		];

		if (isset($this->maskPosition)){
			$array["mask_position"] = $this->maskPosition->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string|InputFile
	 */
	public function getSticker(): InputFile|string
	{
		return $this->sticker;
	}

	/**
	 * @return string
	 */
	public function getFormat(): string
	{
		return $this->format;
	}

	/**
	 * @return string[]
	 */
	public function getEmojiList(): array
	{
		return $this->emojiList;
	}

	/**
	 * @return MaskPosition|null
	 */
	public function getMaskPosition(): ?MaskPosition
	{
		return $this->maskPosition;
	}

	/**
	 * @return string[]
	 */
	public function getKeywords(): array
	{
		return $this->keywords;
	}
}