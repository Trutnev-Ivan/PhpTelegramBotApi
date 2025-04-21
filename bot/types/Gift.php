<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#gift
 */
class Gift implements \JsonSerializable
{
	protected string $id;
	protected Sticker $sticker;
	protected int $starCount;
	protected ?int $upgradeStarCount;
	protected ?int $totalCount;
	protected ?int $remainingCount;

	public function __construct(
		string $id = "",
		Sticker $sticker = null,
		int $starCount = 0,
		?int $upgradeStarCount = null,
		?int $totalCount = null,
		?int $remainingCount = null
	)
	{
		$this->id = $id;
		$this->sticker = $sticker;
		$this->starCount = $starCount;
		$this->upgradeStarCount = $upgradeStarCount;
		$this->totalCount = $totalCount;
		$this->remainingCount = $remainingCount;
	}

	public static function fromArray(array $array): Gift
	{
		return new static(
			$array["id"] ?? "",
			$array["sticker"] ? Sticker::fromArray($array["sticker"]) : null,
			$array["star_count"] ?? 0,
			$array["upgrade_star_count"],
			$array["total_count"],
			$array["remaining_count"]
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"sticker" => $this->sticker->jsonSerialize(),
			"star_count" => $this->starCount,
		];

		if (isset($this->upgradeStarCount)) {
			$array["upgrade_star_count"] = $this->upgradeStarCount;
		}
		if (isset($this->totalCount)) {
			$array["total_count"] = $this->totalCount;
		}
		if (isset($this->remainingCount)) {
			$array["remaining_count"] = $this->remainingCount;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return Sticker
	 */
	public function getSticker(): Sticker
	{
		return $this->sticker;
	}

	/**
	 * @return int
	 */
	public function getStarCount(): int
	{
		return $this->starCount;
	}

	/**
	 * @return int|null
	 */
	public function getUpgradeStarCount(): ?int
	{
		return $this->upgradeStarCount;
	}

	/**
	 * @return int|null
	 */
	public function getTotalCount(): ?int
	{
		return $this->totalCount;
	}

	/**
	 * @return int|null
	 */
	public function getRemainingCount(): ?int
	{
		return $this->remainingCount;
	}
}