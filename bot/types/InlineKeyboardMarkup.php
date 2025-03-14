<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
class InlineKeyboardMarkup implements \JsonSerializable
{
	/**
	 * @var InlineKeyboardButton[]
	 */
	protected array $inlineKeyboard;

	public function __construct(
		array $inlineKeyboard = []
	)
	{
		$this->inlineKeyboard = $inlineKeyboard;

		foreach ($this->inlineKeyboard as $keyboard) {
			if (!$keyboard instanceof InlineKeyboardButton) {
				throw new \InvalidArgumentException("InlineKeyboardMarkup must contain only " . InlineKeyboardButton::class);
			}
		}
	}

	public static function fromArray(array $array): InlineKeyboardMarkup
	{
		return new static(
			$array["inline_keyboard"] ? array_map(fn($keyboard) => InlineKeyboardButton::fromArray($keyboard), $array["inline_keyboard"]) : []
		);
	}

	public function jsonSerialize()
	{
		return [
			"inline_keyboard" => $this->inlineKeyboard ? array_map(fn($keyboard) => $keyboard->jsonSerialize(), $this->inlineKeyboard) : [],
		];
	}

	/**
	 * @return array
	 */
	public function getInlineKeyboard(): array
	{
		return $this->inlineKeyboard;
	}
}