<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#shippingoption
 */
class ShippingOption implements \JsonSerializable
{
	protected string $id;
	protected string $title;
	/**
	 * @var LabeledPrice[]
	 */
	protected array $prices;

	public function __construct(
		string $id = "",
		string $title = "",
		array $prices = []
	)
	{
		$this->id = $id;
		$this->title = $title;
		$this->prices = $prices;

		foreach ($this->prices as $price) {
			if (!$price instanceof LabeledPrice) {
				throw new \InvalidArgumentException("All prices must be instances of LabeledPrice.");
			}
		}
	}

	public static function fromArray(array $array): ShippingOption
	{
		return new static(
			$array["id"] ?? "",
			$array["title"] ?? "",
			$array["prices"] ? array_map(fn($price) => LabeledPrice::fromArray($price), $array["prices"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"id" => $this->id,
			"title" => $this->title,
			"prices" => $this->prices ? array_map(fn($price) => $price->jsonSerialize(), $this->prices) : [],
		];
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return LabeledPrice[]
	 */
	public function getPrices(): array
	{
		return $this->prices;
	}
}