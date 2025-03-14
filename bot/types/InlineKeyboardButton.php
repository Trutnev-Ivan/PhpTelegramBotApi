<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
class InlineKeyboardButton implements \JsonSerializable
{
	protected string $text;
	protected ?string $url;
	protected ?string $callbackData;
	protected ?WebAppInfo $webApp;
	protected ?LoginUrl $loginUrl;
	protected ?string $switchInlineQuery;
	protected ?string $switchInlineQueryCurrentChat;

	public function __construct(
		string $text = "",
		?string $url = null,
		?string $callbackData = null,
		?WebAppInfo $webApp = null,
		?LoginUrl $loginUrl = null,
		?string $switchInlineQuery = null,
		?string $switchInlineQueryCurrentChat = null
	)
	{
		$this->text = $text;
		$this->url = $url;
		$this->callbackData = $callbackData;
		$this->webApp = $webApp;
		$this->loginUrl = $loginUrl;
		$this->switchInlineQuery = $switchInlineQuery;
		$this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
	}

	public static function fromArray(array $array): InlineKeyboardButton
	{
		return new static(
			$array["text"] ?? "",
			$array["url"],
			$array["callback_data"],
			$array["web_app"] ? WebAppInfo::fromArray($array["web_app"]) : null,
			$array["login_url"] ? LoginUrl::fromArray($array["login_url"]) : null,
			$array["switch_inline_query"],
			$array["switch_inline_query_current_chat"],
		);
	}

	public function jsonSerialize()
	{
		return [
			"text" => $this->text,
			"url" => $this->url,
			"callback_data" => $this->callbackData,
			"web_app" => $this->webApp ? $this->webApp->jsonSerialize() : null,
			"login_url" => $this->loginUrl ? $this->loginUrl->jsonSerialize() : null,
			"switch_inline_query" => $this->switchInlineQuery,
			"switch_inline_query_current_chat" => $this->switchInlineQueryCurrentChat,
		];
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @return string|null
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * @return string|null
	 */
	public function getCallbackData(): ?string
	{
		return $this->callbackData;
	}

	/**
	 * @return WebAppInfo|null
	 */
	public function getWebApp(): ?WebAppInfo
	{
		return $this->webApp;
	}

	/**
	 * @return LoginUrl|null
	 */
	public function getLoginUrl(): ?LoginUrl
	{
		return $this->loginUrl;
	}

	/**
	 * @return string|null
	 */
	public function getSwitchInlineQuery(): ?string
	{
		return $this->switchInlineQuery;
	}

	/**
	 * @return string|null
	 */
	public function getSwitchInlineQueryCurrentChat(): ?string
	{
		return $this->switchInlineQueryCurrentChat;
	}
}