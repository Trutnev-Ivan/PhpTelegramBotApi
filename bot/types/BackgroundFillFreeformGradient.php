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
		string $type = "freeform_gradient",
		array $colors = []
	)
	{
		$this->type = $type;
		$this->colors = $colors;

		if ($this->type != "freeform_gradient") {
			throw new \InvalidArgumentException("Invalid background fill type. Only 'freeform_gradient' is allowed.");
		}

		foreach ($this->colors as $color) {
			if (!is_int($color)) {
				throw new \InvalidArgumentException("All colors must be integers.");
			}
		}
	}

	public static function fromArray(array $array): BackgroundFillFreeformGradient
	{
		return new static(
			$array["type"] ?? "freeform_gradient",
			$array["colors"] ?? []
		);
	}

	public function jsonSerialize(): array
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