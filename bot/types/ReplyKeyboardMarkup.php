<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#replykeyboardmarkup
 */
class ReplyKeyboardMarkup implements \JsonSerializable
{
	/**
	 * @var KeyboardButton[]
	 */
	protected array $keyboard;
	protected bool $isPersistent;
	protected bool $resizeKeyboard;
	protected bool $oneTimeKeyboard;
	protected ?string $inputFieldPlaceholder;
	protected bool $selective;

	public function __construct(
		array $keyboard = [],
		bool $isPersistent = false,
		bool $resizeKeyboard = false,
		bool $oneTimeKeyboard = false,
		?string $inputFieldPlaceholder = null,
		bool $selective = false
	)
	{
		$this->keyboard = $keyboard;
		$this->isPersistent = $isPersistent;
		$this->resizeKeyboard = $resizeKeyboard;
		$this->oneTimeKeyboard = $oneTimeKeyboard;
		$this->inputFieldPlaceholder = $inputFieldPlaceholder;
		$this->selective = $selective;

		foreach ($this->keyboard as $keyboard) {
			if (!$keyboard instanceof KeyboardButton) {
				throw new \InvalidArgumentException("All keyboard buttons must be instances of " . KeyboardButton::class);
			}
		}
	}

	public static function fromArray(array $array): ReplyKeyboardMarkup
	{
		return new static(
			$array["keyboard"] ? array_map(fn ($keyboard) => KeyboardButton::fromArray($keyboard), $array["keyboard"]) : [],
			$array["is_persistent"] ?? false,
			$array["resize_keyboard"] ?? false,
			$array["one_time_keyboard"] ?? false,
			$array["input_field_placeholder"],
			$array["selective"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"keyboard" => $this->keyboard ? array_map(fn($keyboard) => $keyboard->jsonSerialize(), $this->keyboard) : [],
			"is_persistent" => $this->isPersistent,
			"resize_keyboard" => $this->resizeKeyboard,
			"one_time_keyboard" => $this->oneTimeKeyboard,
			"input_field_placeholder" => $this->inputFieldPlaceholder,
			"selective" => $this->selective,
		];
	}

	/**
	 * @return array
	 */
	public function getKeyboard(): array
	{
		return $this->keyboard;
	}

	/**
	 * @return bool
	 */
	public function isPersistent(): bool
	{
		return $this->isPersistent;
	}

	/**
	 * @return bool
	 */
	public function isResizeKeyboard(): bool
	{
		return $this->resizeKeyboard;
	}

	/**
	 * @return bool
	 */
	public function isOneTimeKeyboard(): bool
	{
		return $this->oneTimeKeyboard;
	}

	/**
	 * @return string|null
	 */
	public function getInputFieldPlaceholder(): ?string
	{
		return $this->inputFieldPlaceholder;
	}

	/**
	 * @return bool
	 */
	public function isSelective(): bool
	{
		return $this->selective;
	}
}