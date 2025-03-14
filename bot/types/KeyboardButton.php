<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#keyboardbutton
 */
class KeyboardButton implements \JsonSerializable
{
	protected string $text;
	protected ?KeyboardButtonRequestUsers $requestUsers;
	protected ?KeyboardButtonRequestChat $requestChat;
	protected bool $requestContact;
	protected bool $requestLocation;
	protected ?KeyboardButtonPollType $requestPoll;
	protected ?WebAppInfo $webApp;

	public function __construct(
		string $text = "",
		?KeyboardButtonRequestUsers $requestUsers = null,
		?KeyboardButtonRequestChat $requestChat = null,
		bool $requestContact = false,
		bool $requestLocation = false,
		?KeyboardButtonPollType $requestPoll = null,
		?WebAppInfo $webApp = null
	)
	{
		$this->text = $text;
		$this->requestUsers = $requestUsers;
		$this->requestChat = $requestChat;
		$this->requestContact = $requestContact;
		$this->requestLocation = $requestLocation;
		$this->requestPoll = $requestPoll;
		$this->webApp = $webApp;
	}

	public static function fromArray(array $array): KeyboardButton
	{
		return new static(
			$array["text"] ?? "",
			$array["request_users"] ? KeyboardButtonRequestUsers::fromArray($array["request_users"]) : null,
			$array["request_chat"] ? KeyboardButtonRequestChat::fromArray($array["request_chat"]) : null,
			$array["request_contact"] ?? false,
			$array["request_location"] ?? false,
			$array["request_poll"] ? KeyboardButtonPollType::fromArray($array["request_poll"]) : null,
			$array["web_app"] ? WebAppInfo::fromArray($array["web_app"]) : null
		);
	}

	public function jsonSerialize()
	{
		return [
			"text" => $this->text,
			"request_users" => $this->requestUsers ? $this->requestUsers->jsonSerialize() : null,
			"request_chat" => $this->requestChat ? $this->requestChat->jsonSerialize() : null,
			"request_contact" => $this->requestContact,
			"request_location" => $this->requestLocation,
			"request_poll" => $this->requestPoll ? $this->requestPoll->jsonSerialize() : null,
			"web_app" => $this->webApp ? $this->webApp->jsonSerialize() : null,
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
	 * @return KeyboardButtonRequestUsers|null
	 */
	public function getRequestUsers(): ?KeyboardButtonRequestUsers
	{
		return $this->requestUsers;
	}

	/**
	 * @return KeyboardButtonRequestChat|null
	 */
	public function getRequestChat(): ?KeyboardButtonRequestChat
	{
		return $this->requestChat;
	}

	/**
	 * @return bool
	 */
	public function isRequestContact(): bool
	{
		return $this->requestContact;
	}

	/**
	 * @return bool
	 */
	public function isRequestLocation(): bool
	{
		return $this->requestLocation;
	}

	/**
	 * @return KeyboardButtonPollType|null
	 */
	public function getRequestPoll(): ?KeyboardButtonPollType
	{
		return $this->requestPoll;
	}

	/**
	 * @return WebAppInfo|null
	 */
	public function getWebApp(): ?WebAppInfo
	{
		return $this->webApp;
	}
}