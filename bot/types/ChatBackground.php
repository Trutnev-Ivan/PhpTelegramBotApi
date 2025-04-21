<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatbackground
 */
class ChatBackground implements \JsonSerializable
{
	protected BackgroundTypeFill|BackgroundTypeWallpaper|BackgroundTypePattern|BackgroundTypeChatTheme $type;

	public function __construct(BackgroundTypeFill|BackgroundTypeWallpaper|BackgroundTypePattern|BackgroundTypeChatTheme $type)
	{
		$this->type = $type;
	}

	public static function fromArray(array $array): ChatBackground
	{
		return new static(BackgroundType::fromArray($array["type"]));
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type->jsonSerialize()
		];
	}

	/**
	 * @return BackgroundTypeFill|BackgroundTypeWallpaper|BackgroundTypePattern|BackgroundTypeChatTheme
	 */
	public function getType(): BackgroundTypeFill|BackgroundTypeWallpaper|BackgroundTypePattern|BackgroundTypeChatTheme
	{
		return $this->type;
	}
}