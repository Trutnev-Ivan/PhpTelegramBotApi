<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botdescription
 */
class BotDescription implements \JsonSerializable
{
	protected string $description;

	public function __construct(string $description = "")
	{
		$this->description = $description;
	}

	public static function fromArray(array $array): BotDescription
	{
		return new static($array["description"] ?? "");
	}

	public function jsonSerialize(): array
	{
		return [
			"description" => $this->description,
		];
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}
}