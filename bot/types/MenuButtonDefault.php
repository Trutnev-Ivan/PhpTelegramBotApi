<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#menubuttondefault
 */
class MenuButtonDefault implements \JsonSerializable
{
	protected string $type = "default";

	public function __construct(
		string $type = "default"
	)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): MenuButtonDefault
	{
		return new static($array["type"] ?? "");
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}