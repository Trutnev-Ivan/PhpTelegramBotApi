<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#inlinequeryresultgame
 */
class InlineQueryResultGame implements \JsonSerializable
{
	protected string $type;
	protected string $id;
	protected string $gameShortName;
	protected ?InlineKeyboardMarkup $replyMarkup;

	public function __construct(
		string $type = "game",
		string $id = "",
		string $gameShortName = "",
		?InlineKeyboardMarkup $replyMarkup = null
	)
	{
		$this->type = $type;
		$this->id = $id;
		$this->gameShortName = $gameShortName;
		$this->replyMarkup = $replyMarkup;

		if ($this->type != "game") {
			throw new \InvalidArgumentException("Type must be 'game'");
		}
	}

	public static function fromArray(array $array): InlineQueryResultGame
	{
		return new static(
			$array["type"] ?? "game",
			$array["id"] ?? "",
			$array["game_short_name"] ?? "",
			isset($array["reply_markup"]) ? InlineKeyboardMarkup::fromArray($array["reply_markup"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"type" => $this->type,
			"id" => $this->id,
			"game_short_name" => $this->gameShortName,
		];

		if (isset($this->replyMarkup)) {
			$array["reply_markup"] = $this->replyMarkup->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
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
	public function getGameShortName(): string
	{
		return $this->gameShortName;
	}

	/**
	 * @return InlineKeyboardMarkup|null
	 */
	public function getReplyMarkup(): ?InlineKeyboardMarkup
	{
		return $this->replyMarkup;
	}
}