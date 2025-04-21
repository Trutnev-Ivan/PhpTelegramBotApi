<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#sentwebappmessage
 */
class SentWebAppMessage implements \JsonSerializable
{
	protected ?string $inlineMessageId;

	public function __construct(?string $inlineMessageId = null)
	{
		$this->inlineMessageId = $inlineMessageId;
	}

	public static function fromArray(array $array): SentWebAppMessage
	{
		return new static($array["inline_message_id"]);
	}

	public function jsonSerialize(): array
	{
		$array = [];

		if (isset($this->inlineMessageId)) {
			$array["inline_message_id"] = $this->inlineMessageId;
		}

		return $array;
	}
}