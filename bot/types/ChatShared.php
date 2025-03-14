<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#chatshared
 */
class ChatShared implements \JsonSerializable
{
	protected int $requestId;
	protected int $chatId;
	protected ?string $title;
	protected ?string $username;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;

	public function __construct(
		int $requestId,
		int $chatId,
		?string $title = null,
		?string $username = null,
		array $photo = []
	)
	{
		$this->requestId = $requestId;
		$this->chatId = $chatId;
		$this->title = $title;
		$this->username = $username;
		$this->photo = $photo;

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("photo must be an instance of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): ChatShared
	{
		return new static(
			$array["request_id"] ?? 0,
			$array["chat_id"] ?? 0,
			$array["title"] ?? null,
			$array["username"] ?? null,
			$array["photo"] ? array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photo"]) : [],
		);
	}

	public function jsonSerialize()
	{
		return [
			"request_id" => $this->requestId,
			"chat_id" => $this->chatId,
			"title" => $this->title,
			"username" => $this->username,
			"photo" => $this->photo ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photo) : [],
		];
	}
}