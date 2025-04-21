<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypefill
 */
class BackgroundTypeFill implements \JsonSerializable
{
	protected string $type;
	protected BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient $fill;
	protected int $darkThemeDimming;

	public function __construct(
		string $type = "fill",
		BackgroundFillSolid|BackgroundFillGradient|BackgroundFillFreeformGradient $fill = null,
		int $darkThemeDimming = 0,
	)
	{
		$this->type = $type;
		$this->fill = $fill;
		$this->darkThemeDimming = $darkThemeDimming;

		if ($this->type != "fill"){
			throw new \InvalidArgumentException("Backrgound type fill must be 'fill'");
		}
	}

	public static function fromArray(array $array): BackgroundTypeFill
	{
		return new static(
			$array["type"] ?? "fill",
			BackgroundFill::fromArray($array["fill"]),
			$array["dark_theme_dimming"] ?? 0,
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"fill" => $this->fill->jsonSerialize(),
			"dark_theme_dimming" => $this->darkThemeDimming,
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
	 * @return BackgroundFillFreeformGradient|BackgroundFillGradient|BackgroundFillSolid
	 */
	public function getFill(): BackgroundFillFreeformGradient|BackgroundFillGradient|BackgroundFillSolid
	{
		return $this->fill;
	}

	/**
	 * @return int
	 */
	public function getDarkThemeDimming(): int
	{
		return $this->darkThemeDimming;
	}
}