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

		foreach ($this->inlineKeyboard as $keyboards) {
			foreach ($keyboards as $keyboard) {
				if (!$keyboard instanceof InlineKeyboardButton) {
					throw new \InvalidArgumentException("InlineKeyboardMarkup must contain only " . InlineKeyboardButton::class);
				}
			}
		}
	}

	public static function fromArray(array $array): InlineKeyboardMarkup
	{
		$keyboards = [];

		if (is_array($array["inline_keyboard"])) {
			foreach ($array["inline_keyboard"] as $keyboard) {
				$keyboards[] = InlineKeyboardButton::fromArray($keyboard);
			}
		}

		return new static(
			$keyboards
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"inline_keyboard" => $this->inlineKeyboard,
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