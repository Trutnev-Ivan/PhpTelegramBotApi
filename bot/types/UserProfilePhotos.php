<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#userprofilephotos
 */
class UserProfilePhotos implements \JsonSerializable
{
	protected int $totalCount;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photos;

	public function __construct(
		int $totalCount,
		array $photos = []
	)
	{
		$this->totalCount = $totalCount;
		$this->photos = $photos;

		foreach ($this->photos as $photo) {
			if (!($photo instanceof PhotoSize)) {
				throw new \InvalidArgumentException("All elements in photos array must be instances of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): UserProfilePhotos
	{
		return new static(
			$array["total_count"] ?? 0,
			$array["photos"] ? array_map(fn($photo) => PhotoSize::fromArray($photo), $array["photos"]) : [],
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"total_count" => $this->totalCount,
			"photos" => $this->photos ? array_map(fn($photo) => $photo->jsonSerialize(), $this->photos) : [],
		];
	}

	/**
	 * @return int
	 */
	public function getTotalCount(): int
	{
		return $this->totalCount;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getPhotos(): array
	{
		return $this->photos;
	}
}