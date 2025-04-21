<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#videochatparticipantsinvited
 */
class VideoChatParticipantsInvited implements \JsonSerializable
{
	/**
	 * @var User[]
	 */
	protected array $users;

	public function __construct(
		array $users = []
	)
	{
		$this->users = $users;

		foreach ($this->users as $user) {
			if (!$user instanceof User) {
				throw new \InvalidArgumentException("All elements in 'users' must be instances of " . User::class);
			}
		}
	}

	public static function fromArray(array $array): VideoChatParticipantsInvited
	{
		return new static(
			$array["users"] ? array_map(fn($user) => User::fromArray($user), $array["users"]) : []
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"users" => $this->users ? array_map(fn($user) => $user->jsonSerialize(), $this->users) : [],
		];
	}

	/**
	 * @return User[]
	 */
	public function getUsers(): array
	{
		return $this->users;
	}
}