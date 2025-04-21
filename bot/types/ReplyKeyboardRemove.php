<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#replykeyboardremove
 */
class ReplyKeyboardRemove implements \JsonSerializable
{
	protected bool $removeKeyboard;
	protected bool $selective;

	public function __construct(
		bool $removeKeyboard = false,
		bool $selective = false
	)
	{
		$this->removeKeyboard = $removeKeyboard;
		$this->selective = $selective;
	}

	public static function fromArray(array $array): ReplyKeyboardRemove
	{
		return new static(
			$array["remove_keyboard"] ?? false,
			$array["selective"] ?? false
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"remove_keyboard" => $this->removeKeyboard,
			"selective" => $this->selective,
		];
	}

	/**
	 * @return bool
	 */
	public function isRemoveKeyboard(): bool
	{
		return $this->removeKeyboard;
	}

	/**
	 * @return bool
	 */
	public function isSelective(): bool
	{
		return $this->selective;
	}
}