<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#linkpreviewoptions
 */
class LinkPreviewOptions implements \JsonSerializable
{
	protected bool $isDisabled;
	protected ?string $url;
	protected bool $preferSmallMedia;
	protected bool $preferLargeMedia;
	protected bool $showAboveText;

	public function __construct(
		bool $isDisabled = false,
		?string $url = null,
		bool $preferSmallMedia = false,
		bool $preferLargeMedia = false,
		bool $showAboveText = false
	)
	{
		$this->isDisabled = $isDisabled;
		$this->url = $url;
		$this->preferSmallMedia = $preferSmallMedia;
		$this->preferLargeMedia = $preferLargeMedia;
		$this->showAboveText = $showAboveText;
	}

	public static function fromArray(array $array): LinkPreviewOptions
	{
		return new static(
			$array["is_disabled"] ?? false,
			$array["url"],
			$array["prefer_small_media"] ?? false,
			$array["prefer_large_media"] ?? false,
			$array["show_above_text"] ?? false,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"is_disabled" => $this->isDisabled,
			"prefer_small_media" => $this->preferSmallMedia,
			"prefer_large_media" => $this->preferLargeMedia,
			"show_above_text" => $this->showAboveText,
		];

		if (isset($this->url)) {
			$array["url"] = $this->url;
		}

		return $array;
	}

	/**
	 * @return bool
	 */
	public function isDisabled(): bool
	{
		return $this->isDisabled;
	}

	/**
	 * @return string|null
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * @return bool
	 */
	public function isPreferSmallMedia(): bool
	{
		return $this->preferSmallMedia;
	}

	/**
	 * @return bool
	 */
	public function isPreferLargeMedia(): bool
	{
		return $this->preferLargeMedia;
	}

	/**
	 * @return bool
	 */
	public function isShowAboveText(): bool
	{
		return $this->showAboveText;
	}
}