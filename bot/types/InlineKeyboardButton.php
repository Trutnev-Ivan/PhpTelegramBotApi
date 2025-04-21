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
	protected ?SwitchInlineQueryChosenChat $switchInlineQueryChosenChat;
	protected ?CopyTextButton $copyText;
	protected ?CallbackGame $callbackGame;

	public function __construct(
		string $text = "",
		?string $url = null,
		?string $callbackData = null,
		?WebAppInfo $webApp = null,
		?LoginUrl $loginUrl = null,
		?string $switchInlineQuery = null,
		?string $switchInlineQueryCurrentChat = null,
		?SwitchInlineQueryChosenChat $switchInlineQueryChosenChat = null,
		?CopyTextButton $copyText = null,
		?CallbackGame $callbackGame = null
	)
	{
		$this->text = $text;
		$this->url = $url;
		$this->callbackData = $callbackData;
		$this->webApp = $webApp;
		$this->loginUrl = $loginUrl;
		$this->switchInlineQuery = $switchInlineQuery;
		$this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
		$this->switchInlineQueryChosenChat = $switchInlineQueryChosenChat;
		$this->copyText = $copyText;
		$this->callbackGame = $callbackGame;
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
			$array["switch_inline_query_chosen_chat"] ? SwitchInlineQueryChosenChat::fromArray($array["switch_inline_query_chosen_chat"]) : null,
			$array["copy_text"] ? CopyTextButton::fromArray($array["copy_text"]) : null,
			$array["callback_game"] ? new CallbackGame : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"text" => $this->text,
		];

		if (isset($this->url)) {
			$array["url"] = $this->url;
		}
		if (isset($this->callbackData)) {
			$array["callback_data"] = $this->callbackData;
		}
		if (isset($this->webApp)) {
			$array["web_app"] = $this->webApp->jsonSerialize();
		}
		if (isset($this->loginUrl)) {
			$array["login_url"] = $this->loginUrl->jsonSerialize();
		}
		if (isset($this->switchInlineQuery)) {
			$array["switch_inline_query"] = $this->switchInlineQuery;
		}
		if (isset($this->switchInlineQueryCurrentChat)) {
			$array["switch_inline_query_current_chat"] = $this->switchInlineQueryCurrentChat;
		}
		if (isset($this->switchInlineQueryChosenChat)){
			$array["switch_inline_query_chosen_chat"] = $this->switchInlineQueryChosenChat->jsonSerialize();
		}
		if (isset($this->copyText)){
			$array["copy_text"] = $this->copyText->jsonSerialize();
		}

		return $array;
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

	/**
	 * @return SwitchInlineQueryChosenChat|null
	 */
	public function getSwitchInlineQueryChosenChat(): ?SwitchInlineQueryChosenChat
	{
		return $this->switchInlineQueryChosenChat;
	}

	/**
	 * @return CopyTextButton|null
	 */
	public function getCopyText(): ?CopyTextButton
	{
		return $this->copyText;
	}

	/**
	 * @return CallbackGame|null
	 */
	public function getCallbackGame(): ?CallbackGame
	{
		return $this->callbackGame;
	}
}