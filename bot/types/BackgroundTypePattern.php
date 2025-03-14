<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypepattern
 */
class BackgroundTypePattern implements \JsonSerializable
{
	protected string $type;
	protected Document $document;
	protected BackgroundFill $fill;
	protected int $intensity;
	protected bool $isInverted;
	protected bool $isMoving;

	public function __construct(
		string $type,
		Document $document = null,
		BackgroundFill $fill = null,
		int $intensity = 100,
		bool $isInverted = false,
		bool $isMoving = false
	)
	{
		$this->type = $type;
		$this->document = $document;
		$this->fill = $fill;
		$this->intensity = $intensity;
		$this->isInverted = $isInverted;
		$this->isMoving = $isMoving;
	}

	public static function fromArray(array $array): BackgroundTypePattern
	{
		return new static(
			$array["type"] ?? "",
			$array["document"] ? Document::fromArray($array["document"]) : null,
			$array["fill"] ? BackgroundFill::fromArray($array["fill"]) : null,
			$array["intensity"] ?? 100,
			$array["is_inverted"] ?? false,
			$array["is_moving"] ?? false
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"document" => $this->document ? $this->document->jsonSerialize() : null,
			"fill" => $this->fill ? $this->fill->jsonSerialize() : null,
			"intensity" => $this->intensity,
			"is_inverted" => $this->isInverted,
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
	 * @return BackgroundFill
	 */
	public function getFill(): BackgroundFill
	{
		return $this->fill;
	}

	/**
	 * @return int
	 */
	public function getIntensity(): int
	{
		return $this->intensity;
	}

	/**
	 * @return bool
	 */
	public function isInverted(): bool
	{
		return $this->isInverted;
	}

	/**
	 * @return bool
	 */
	public function isMoving(): bool
	{
		return $this->isMoving;
	}
}