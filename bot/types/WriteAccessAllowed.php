<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#writeaccessallowed
 */
class WriteAccessAllowed implements \JsonSerializable
{
	protected bool $fromRequest;
	protected ?string $webAppName;
	protected bool $fromAttachmentMenu;

	public function __construct(
		bool $fromRequest = false,
		?string $webAppName = null,
		bool $fromAttachmentMenu = false
	)
	{
		$this->fromRequest = $fromRequest;
		$this->webAppName = $webAppName;
		$this->fromAttachmentMenu = $fromAttachmentMenu;
	}

	public static function fromArray(array $array): WriteAccessAllowed
	{
		return new static(
			$array["from_request"] ?? false,
			$array["web_app_name"] ?? null,
			$array["from_attachment_menu"] ?? false,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"from_request" => $this->fromRequest,
			"from_attachment_menu" => $this->fromAttachmentMenu,
		];

		if (isset($this->webAppName)){
			$array["web_app_name"] = $this->webAppName;
		}

		return $array;
	}

	/**
	 * @return bool
	 */
	public function isFromRequest(): bool
	{
		return $this->fromRequest;
	}

	/**
	 * @return string|null
	 */
	public function getWebAppName(): ?string
	{
		return $this->webAppName;
	}

	/**
	 * @return bool
	 */
	public function isFromAttachmentMenu(): bool
	{
		return $this->fromAttachmentMenu;
	}
}