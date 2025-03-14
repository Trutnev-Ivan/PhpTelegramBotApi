<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatbackground
 */
class ChatBackground implements \JsonSerializable
{
	protected BackgroundType $type;

	public function __construct(BackgroundType $type)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): ChatBackground
	{
		return new static(BackgroundType::fromArray($array["type"]));
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type->jsonSerialize()
		];
	}

	/**
	 * @return BackgroundType
	 */
	public function getType(): BackgroundType
	{
		return $this->type;
	}
}