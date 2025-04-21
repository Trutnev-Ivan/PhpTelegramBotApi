<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediaphoto
 */
class PaidMediaPhoto implements \JsonSerializable
{
	protected string $type;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;

	public function __construct(
		string $type = "photo",
		array $photo = []
	)
	{
		$this->type = $type;
		$this->photo = $photo;

		if ($this->type != "photo"){
			throw new \InvalidArgumentException("type must be 'photo', got {$this->type}");
		}

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("photo must be an instance of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): PaidMediaPhoto
	{
		return new static(
			$array["type"] ?? "photo",
			$array["photo"] ? array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photo"]) : [],
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"photo" => $this->photo ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photo) : [],
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
	 * @return PhotoSize[]
	 */
	public function getPhoto(): array
	{
		return $this->photo;
	}
}