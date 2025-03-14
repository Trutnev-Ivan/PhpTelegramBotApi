<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#backgroundtypechattheme
 */
class BackgroundTypeChatTheme implements \JsonSerializable
{
	protected string $type;
	protected string $themeName;

	public function __construct(
		string $type = "",
		string $themeName = ""
	)
	{
		$this->type = $type;
		$this->themeName = $themeName;
	}

	public static function fromArray(array $array): BackgroundTypeChatTheme
	{
		return new static(
			$array["type"] ?? "",
			$array["theme_name"] ?? ""
		);
	}

	public function jsonSerialize()
	{
		return [
			"type" => $this->type,
			"theme_name" => $this->themeName,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getThemeName(): string
	{
		return $this->themeName;
	}
}