<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#gamehighscore
 */
class GameHighScore implements \JsonSerializable
{
	protected int $position;
	protected User $user;
	protected int $score;

	public function __construct(
		int $position,
		User $user,
		int $score
	)
	{
		$this->position = $position;
		$this->user = $user;
		$this->score = $score;
	}

	public static function fromArray(array $array): GameHighScore
	{
		return new static(
			$array["position"] ?? 0,
			User::fromArray($array["user"]),
			$array["score"] ?? 0
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"position" => $this->position,
			"user" => $this->user->jsonSerialize(),
			"score" => $this->score,
		];
	}

	/**
	 * @return int
	 */
	public function getPosition(): int
	{
		return $this->position;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return int
	 */
	public function getScore(): int
	{
		return $this->score;
	}
}