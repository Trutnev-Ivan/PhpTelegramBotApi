<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypepattern
 */
class BackgroundTypePattern implements \JsonSerializable
{
	protected string $type;
	protected Document $document;
	protected BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient $fill;
	protected int $intensity;
	protected bool $isInverted;
	protected bool $isMoving;

	public function __construct(
		string $type = "pattern",
		Document $document = null,
		BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient $fill = null,
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

		if ($this->type != "pattern"){
			throw new \InvalidArgumentException("Invalid background type. Must be 'pattern'");
		}
	}

	public static function fromArray(array $array): BackgroundTypePattern
	{
		return new static(
			$array["type"] ?? "pattern",
			Document::fromArray($array["document"]),
			BackgroundFill::fromArray($array["fill"]),
			$array["intensity"] ?? 100,
			$array["is_inverted"] ?? false,
			$array["is_moving"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"document" => $this->document->jsonSerialize(),
			"fill" => $this->fill->jsonSerialize(),
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
	public function getFill(): BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient
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