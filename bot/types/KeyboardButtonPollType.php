<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#keyboardbuttonpolltype
 */
class KeyboardButtonPollType implements \JsonSerializable
{
	protected ?string $type;

	public function __construct(
		?string $type = null
	)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): KeyboardButtonPollType
	{
		return new static(
			$array["type"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [];

		if (isset($this->type)){
			$array["type"] = $this->type;
		}

		return $array;
	}

	/**
	 * @return string|null
	 */
	public function getType(): ?string
	{
		return $this->type;
	}
}