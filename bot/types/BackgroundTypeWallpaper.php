<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypewallpaper
 */
class BackgroundTypeWallpaper implements \JsonSerializable
{
	protected string $type;
	protected Document $document;
	protected int $darkThemeDimming;
	protected bool $isBlurred;
	protected bool $isMoving;

	public function __construct(
		string $type = "",
		Document $document = null,
		int $darkThemeDimming = 0,
		bool $isBlurred = false,
		bool $isMoving = false
	)
	{
		$this->type = $type;
		$this->document = $document;
		$this->darkThemeDimming = $darkThemeDimming;
		$this->isBlurred = $isBlurred;
		$this->isMoving = $isMoving;
	}

	public static function fromArray(array $array): BackgroundTypeWallpaper
	{
		return new static(
			$array["type"] ?? "",
			$array["document"] ? Document::fromArray($array["document"]) : null,
			$array["dark_theme_dimming"] ?? 0,
			$array["is_blurred"] ?? false,
			$array["is_moving"] ?? false
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"document" => $this->document ? $this->document->jsonSerialize() : null,
			"dark_theme_dimming" => $this->darkThemeDimming,
			"is_blurred" => $this->isBlurred,
			"is_moving" => $this->isMoving,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return Document
	 */
	public function getDocument(): Document
	{
		return $this->document;
	}

	/**
	 * @return int
	 */
	public function getDarkThemeDimming(): int
	{
		return $this->darkThemeDimming;
	}

	/**
	 * @return bool
	 */
	public function isBlurred(): bool
	{
		return $this->isBlurred;
	}

	/**
	 * @return bool
	 */
	public function isMoving(): bool
	{
		return $this->isMoving;
	}
}
