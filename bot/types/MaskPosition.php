<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#maskposition
 */
class MaskPosition implements \JsonSerializable
{
	protected string $point;
	protected float $xShift;
	protected float $yShift;
	protected float $scale;

	public function __construct(
		string $point = "",
		float $xShift = 0.0,
		float $yShift = 0.0,
		float $scale = 0.0
	)
	{
		$this->point = $point;
		$this->xShift = $xShift;
		$this->yShift = $yShift;
		$this->scale = $scale;
	}

	public static function fromArray(array $array): MaskPosition
	{
		return new static(
			$array["point"] ?? "",
			$array["x_shift"] ?? 0.0,
			$array["y_shift"] ?? 0.0,
			$array["scale"] ?? 0.0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"point" => $this->point,
			"x_shift" => $this->xShift,
			"y_shift" => $this->yShift,
			"scale" => $this->scale,
		];
	}

	/**
	 * @return string
	 */
	public function getPoint(): string
	{
		return $this->point;
	}

	/**
	 * @return float
	 */
	public function getXShift(): float
	{
		return $this->xShift;
	}

	/**
	 * @return float
	 */
	public function getYShift(): float
	{
		return $this->yShift;
	}

	/**
	 * @return float
	 */
	public function getScale(): float
	{
		return $this->scale;
	}
}