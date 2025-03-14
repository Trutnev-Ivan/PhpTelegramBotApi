<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundfillgradient
 */
class BackgroundFillGradient implements \JsonSerializable
{
	protected string $type;
	protected int $topColor;
	protected int $bottomColor;
	protected int $rotationAngle;

	public function __construct(
		string $type,
		int $topColor,
		int $bottomColor,
		int $rotationAngle
	)
	{
		$this->type = $type;
		$this->topColor = $topColor;
		$this->bottomColor = $bottomColor;
		$this->rotationAngle = $rotationAngle;
	}

	public static function fromArray(array $array): BackgroundFillGradient
	{
		return new static(
			$array["type"] ?? "",
			$array["top_color"] ?? 0,
			$array["bottom_color"] ?? 0,
			$array["rotation_angle"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"top_color" => $this->topColor,
			"bottom_color" => $this->bottomColor,
			"rotation_angle" => $this->rotationAngle,
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
	 * @return int
	 */
	public function getTopColor(): int
	{
		return $this->topColor;
	}

	/**
	 * @return int
	 */
	public function getBottomColor(): int
	{
		return $this->bottomColor;
	}

	/**
	 * @return int
	 */
	public function getRotationAngle(): int
	{
		return $this->rotationAngle;
	}
}