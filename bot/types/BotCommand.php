<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#botcommand
 */
class BotCommand implements \JsonSerializable
{
	protected string $command;
	protected string $description;

	public function __construct(
		string $command = "",
		string $description = ""
	)
	{
		$this->command = $command;
		$this->description = $description;
	}

	public static function fromArray(array $array): BotCommand
	{
		return new static(
			$array["command"] ?? "",
			$array["description"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"command" => $this->command,
			"description" => $this->description,
		];
	}

	/**
	 * @return string
	 */
	public function getCommand(): string
	{
		return $this->command;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}
}