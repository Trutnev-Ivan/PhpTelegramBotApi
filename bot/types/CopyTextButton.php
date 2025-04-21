<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#copytextbutton
 */
class CopyTextButton implements \JsonSerializable
{
	protected string $text;

	public function __construct(
		string $text = ""
	)
	{
		$this->text = $text;
	}

	public static function fromArray(array $array): CopyTextButton
	{
		return new static(
			$array["text"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"text" => $this->text,
		];
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}
}