<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#accent-colors
 */
class AccentColors
{
	public static function getColors(): array
	{
		return [
			7 => [
				"light" => [
					"E15052",
					"F9AE63",
				],
				"dark" => [
					"FF9380",
					"992F37",
				],
			],
			8 => [
				"light" => [
					"E0802B",
					"FAC534",
				],
				"dark" => [
					"ECB04E",
					"C35714",
				],
			],
			9 => [
				"light" => [
					"A05FF3",
					"F48FFF",
				],
				"dark" => [
					"C697FF",
					"5E31C8",
				],
			],
			10 => [
				"light" => [
					"27A910",
					"A7DC57",
				],
				"dark" => [
					"A7EB6E",
					"167E2D",
				],
			],
			11 => [
				"light" => [
					"27ACCE",
					"82E8D6",
				],
				"dark" => [
					"40D8D0",
					"045C7F",
				],
			],
			12 => [
				"light" => [
					"3391D4",
					"7DD3F0",
				],
				"dark" => [
					"52BFFF",
					"0B5494",
				],
			],
			13 => [
				"light" => [
					"DD4371",
					"FFBE9F",
				],
				"dark" => [
					"FF86A6",
					"8E366E",
				],
			],
			14 => [
				"light" => [
					"247BED",
					"F04856",
					"FFFFFF",
				],
				"dark" => [
					"3FA2FE",
					"E5424F",
					"FFFFFF",
				],
			],
			15 => [
				"light" => [
					"D67722",
					"1EA011",
					"FFFFFF",
				],
				"dark" => [
					"FF905E",
					"32A527",
					"FFFFFF",
				],
			],
			16 => [
				"light" => [
					"179E42",
					"E84A3F",
					"FFFFFF",
				],
				"dark" => [
					"66D364",
					"D5444F",
					"FFFFFF",
				],
			],
			17 => [
				"light" => [
					"2894AF",
					"6FC456",
					"FFFFFF",
				],
				"dark" => [
					"22BCE2",
					"3DA240",
					"FFFFFF",
				],
			],
			18 => [
				"light" => [
					"0C9AB3",
					"FFAD95",
					"FFE6B5",
				],
				"dark" => [
					"22BCE2",
					"FF9778",
					"FFDA6B",
				],
			],
			19 => [
				"light" => [
					"7757D6",
					"F79610",
					"FFDE8E",
				],
				"dark" => [
					"9791FF",
					"F2731D",
					"FFDB59",
				],
			],
			20 => [
				"light" => [
					"1585CF",
					"F2AB1D",
					"FFFFFF",
				],
				"dark" => [
					"3DA6EB",
					"EEA51D",
					"FFFFFF",
				],
			],
		];
	}

	public static function getById(int $id): array
	{
		return static::getColors()[$id] ?? [];
	}

	public static function getLightColors(int $accentColorId): array
	{
		$colors = static::getColors()[$accentColorId];

		return $colors ? $colors["light"] : [];
	}

	public static function getDarkColors(int $accentColorId): array
	{
		$colors = static::getColors()[$accentColorId];

		return $colors ? $colors["dark"] : [];
	}
}