<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#profile-accent-colors
 */
class ProfileAccentColors
{
	public static function getColors(): array
	{
		return [
			0 => [
				"light" => [
					"BA5650",
				],
				"dark" => [
					"9C4540",
				],
			],
			1 => [
				"light" => [
					"C27C3E",
				],
				"dark" => [
					"945E2C",
				],
			],
			2 => [
				"light" => [
					"956AC8",
				],
				"dark" => [
					"715099",
				],
			],
			3 => [
				"light" => [
					"49A355",
				],
				"dark" => [
					"33713B",
				],
			],
			4 => [
				"light" => [
					"3E97AD",
				],
				"dark" => [
					"387E87",
				],
			],
			5 => [
				"light" => [
					"5A8FBB",
				],
				"dark" => [
					"477194",
				],
			],
			6 => [
				"light" => [
					"B85378",
				],
				"dark" => [
					"944763",
				],
			],
			7 => [
				"light" => [
					"7F8B95",
				],
				"dark" => [
					"435261",
				],
			],
			8 => [
				"light" => [
					"C9565D",
					"D97C57",
				],
				"dark" => [
					"994343",
					"AC583E",
				],
			],
			9 => [
				"light" => [
					"CF7244",
					"CC9433",
				],
				"dark" => [
					"8F552F",
					"A17232",
				],
			],
			10 => [
				"light" => [
					"9662D4",
					"B966B6",
				],
				"dark" => [
					"634691",
					"9250A2",
				],
			],
			11 => [
				"light" => [
					"3D9755",
					"89A650",
				],
				"dark" => [
					"296A43",
					"5F8F44",
				],
			],
			12 => [
				"light" => [
					"3D95BA",
					"50AD98",
				],
				"dark" => [
					"306C7C",
					"3E987E",
				],
			],
			13 => [
				"light" => [
					"538BC2",
					"4DA8BD",
				],
				"dark" => [
					"38618C",
					"458BA1",
				],
			],
			14 => [
				"light" => [
					"B04F74",
					"D1666D",
				],
				"dark" => [
					"884160",
					"A65259",
				],
			],
			15 => [
				"light" => [
					"637482",
					"7B8A97",
				],
				"dark" => [
					"53606E",
					"384654",
				],
			],
		];
	}

	public static function getColor(int $index): array
	{
		$colors = static::getColors();

		return $colors[$index] ?? [];
	}

	public static function getLightColor(int $index): array
	{
		$colors = static::getColor($index);
		return $colors["light"] ?? [];
	}

	public static function getDarkColor(int $index): array
	{
		$colors = static::getColor($index);
		return $colors["dark"] ?? [];
	}
}