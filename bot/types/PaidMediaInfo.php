<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#paidmediainfo
 */
class PaidMediaInfo implements \JsonSerializable
{
	protected int $starCount;
	/**
	 * @var (PaidMediaPhoto|PaidMediaVideo|PaidMediaPreview)[]
	 */
	protected array $paidMedia;

	public function __construct(
		int $starCount = 0,
		array $paidMedia = []
	)
	{
		$this->starCount = $starCount;
		$this->paidMedia = $paidMedia;

		foreach ($this->paidMedia as $paidMedia) {
			if (!$paidMedia instanceof PaidMediaPhoto
				&& !$paidMedia instanceof PaidMediaVideo
				&& !$paidMedia instanceof PaidMediaPreview
			) {
				throw new \InvalidArgumentException("All elements of 'paid_media' must be instances of " . PaidMediaPhoto::class . " or " . PaidMediaVideo::class . " or " . PaidMediaPreview::class);
			}
		}
	}

	public static function fromArray(array $array): PaidMediaInfo
	{
		return new static(
			$array["star_count"] ?? 0,
			$array["paid_media"] ? array_map(fn($media) => PaidMedia::fromArray($media), $array["paid_media"]) : [],
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"star_count" => $this->starCount,
			"paid_media" => $this->paidMedia ? array_map(fn($media) => $media->jsonSerialize(), $this->paidMedia) : [],
		];
	}
}