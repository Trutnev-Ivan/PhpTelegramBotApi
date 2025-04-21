<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundfillsolid
 */
class BackgroundFillSolid implements \JsonSerializable
{
	protected string $type;
	protected int $color;

	public function __construct(
		string $type = "solid",
		int $color = 0
	)
	{
		$this->type = $type;
		$this->color = $color;

		if ($this->type != "solid"){
			throw new \InvalidArgumentException("Invalid background fill type. Expected 'solid'.");
		}
	}

	public static function fromArray(array $array): BackgroundFillSolid
	{
		return new static(
			$array["type"] ?? "solid",
			$array["color"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"color" => $this->color,
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
	public function getColor(): int
	{
		return $this->color;
	}
}