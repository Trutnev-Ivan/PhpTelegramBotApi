<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botshortdescription
 */
class BotShortDescription implements \JsonSerializable
{
	protected string $shortDescription;

	public function __construct(
		string $shortDescription = ""
	)
	{
		$this->shortDescription = $shortDescription;
	}

	public static function fromArray(array $array)
	{
		return new static(
			$array["short_description"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"short_description" => $this->shortDescription,
		];
	}

	/**
	 * @return string
	 */
	public function getShortDescription(): string
	{
		return $this->shortDescription;
	}
}