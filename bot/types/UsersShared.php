<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#usersshared
 */
class UsersShared implements \JsonSerializable
{
	protected int $requestId;
	/**
	 * @var SharedUser[]
	 */
	protected array $users;

	public function __construct(
		int $requestId,
		array $users = []
	)
	{
		$this->requestId = $requestId;
		$this->users = $users;

		foreach ($this->users as $user) {
			if (!$user instanceof SharedUser) {
				throw new \InvalidArgumentException("All elements in 'users' must be instances of " . SharedUser::class);
			}
		}
	}

	public static function fromArray(array $array): UsersShared
	{
		return new static(
			$array["request_id"] ?? 0,
			array_map(fn($item) => SharedUser::fromArray($item), $array["users"] ?? [])
		);
	}

	public function jsonSerialize()
	{
		return [
			"request_id" => $this->requestId,
			"users" => $this->users ? array_map(fn($user) => $user->jsonSerialize(), $this->users) : [],
		];
	}

	/**
	 * @return int
	 */
	public function getRequestId(): int
	{
		return $this->requestId;
	}

	/**
	 * @return SharedUser[]
	 */
	public function getUsers(): array
	{
		return $this->users;
	}
}