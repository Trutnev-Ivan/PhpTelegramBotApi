<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#proximityalerttriggered
 */
class ProximityAlertTriggered implements \JsonSerializable
{
	protected User $traveler;
	protected User $watcher;
	protected int $distance;

	public function __construct(User $traveler, User $watcher, int $distance)
	{
		$this->traveler = $traveler;
		$this->watcher = $watcher;
		$this->distance = $distance;
	}

	public static function fromArray(array $array): ProximityAlertTriggered
	{
		return new static(
			User::fromArray($array["traveler"]),
			User::fromArray($array["watcher"]),
			$array["distance"] ?? 0
		);
	}

	public function jsonSerialize()
	{
		return [
			"traveler" => $this->traveler ? $this->traveler->jsonSerialize() : null,
			"watcher" => $this->watcher ? $this->watcher->jsonSerialize() : null,
			"distance" => $this->distance,
		];
	}
}