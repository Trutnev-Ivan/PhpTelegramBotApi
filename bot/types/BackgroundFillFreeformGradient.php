<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundfillfreeformgradient
 */
class BackgroundFillFreeformGradient implements \JsonSerializable
{
	protected string $type;
	/**
	 * @var int[]
	 */
	protected array $colors;

	public function __construct(
		string $type,
		array $colors = []
	)
	{
		$this->type = $type;
		$this->colors = $colors;

		foreach ($this->colors as $color) {
			if (!is_int($color)) {
				throw new \InvalidArgumentException("All colors must be integers.");
			}
		}
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"colors" => $this->colors,
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
	 * @return int[]
	 */
	public function getColors(): array
	{
		return $this->colors;
	}
}