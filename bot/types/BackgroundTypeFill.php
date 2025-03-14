<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypefill
 */
class BackgroundTypeFill implements \JsonSerializable
{
	protected string $type;
	protected BackgroundFill $fill;
	protected int $darkThemeDimming;

	public function __construct(
		string $type = "",
		BackgroundFill $fill = null,
		int $darkThemeDimming = 0,
	)
	{
		$this->type = $type;
		$this->fill = $fill;
		$this->darkThemeDimming = $darkThemeDimming;
	}

	public static function fromArray(array $array): BackgroundTypeFill
	{
		return new static(
			$array["type"] ?? "",
			$array["fill"]? BackgroundFill::fromArray($array["fill"]) : null,
            $array["dark_theme_dimming"]?? 0,
		);
	}
	
	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"fill" => $this->fill ? $this->fill->jsonSerialize() : null,
			"dark_theme_dimming" => $this->darkThemeDimming,
		];
	}
}