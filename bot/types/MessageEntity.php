<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#messageentity
 */
class MessageEntity implements \JsonSerializable
{
	protected string $type;
	protected int $offset;
	protected int $length;
	protected ?string $url;
	protected ?User $user;
	protected ?string $language;
	protected ?string $customEmojiId;

	public function __construct(
		string $type = "",
		int $offset = 0,
		int $length = 0,
		?string $url = null,
		?User $user = null,
		?string $language = null,
		?string $customEmojiId = null
	)
	{
		$this->type = $type;
		$this->offset = $offset;
		$this->length = $length;
		$this->url = $url;
		$this->user = $user;
		$this->language = $language;
		$this->customEmojiId = $customEmojiId;
	}

	public static function fromArray(array $array): MessageEntity
	{
		return new static(
			$array["type"] ?? "",
			$array["offset"] ?? 0,
			$array["length"] ?? 0,
			$array["url"],
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["language"],
			$array["custom_emoji_id"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"offset" => $this->offset,
			"length" => $this->length,
		];

		if (isset($this->url)) {
			$array["url"] = $this->url;
		}
		if (isset($this->user)) {
			$array["user"] = $this->user->jsonSerialize();
		}
		if (isset($this->language)) {
			$array["language"] = $this->language;
		}
		if (isset($this->customEmojiId)) {
			$array["custom_emoji_id"] = $this->customEmojiId;
		}

		return $array;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getOffset(): int
	{
		return $this->offset;
	}

	public function getLength(): int
	{
		return $this->length;
	}

	public function getUrl(): ?string
	{
		return $this->url;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function getLanguage(): ?string
	{
		return $this->language;
	}

	public function getCustomEmojiId(): ?string
	{
		return $this->customEmojiId;
	}
}