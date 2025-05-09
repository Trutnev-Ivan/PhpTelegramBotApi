<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#loginurl
 */
class LoginUrl implements \JsonSerializable
{
	protected string $url;
	protected ?string $forwardText;
	protected ?string $botUsername;
	protected bool $requestWriteAccess;

	public function __construct(
		string $url = "",
		?string $forwardText = null,
		?string $botUsername = null,
		bool $requestWriteAccess = false
	)
	{
		$this->url = $url;
		$this->forwardText = $forwardText;
		$this->botUsername = $botUsername;
		$this->requestWriteAccess = $requestWriteAccess;
	}

	public static function fromArray(array $array): LoginUrl
	{
		return new static(
			$array["url"] ?? "",
			$array["forward_text"],
			$array["bot_username"],
			$array["request_write_access"] ?? false,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"url" => $this->url,
			"request_write_access" => $this->requestWriteAccess,
		];

		if (isset($this->forwardText)) {
			$array["forward_text"] = $this->forwardText;
		}
		if (isset($this->botUsername)) {
			$array["bot_username"] = $this->botUsername;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @return string|null
	 */
	public function getForwardText(): ?string
	{
		return $this->forwardText;
	}

	/**
	 * @return string|null
	 */
	public function getBotUsername(): ?string
	{
		return $this->botUsername;
	}

	/**
	 * @return bool
	 */
	public function isRequestWriteAccess(): bool
	{
		return $this->requestWriteAccess;
	}
}