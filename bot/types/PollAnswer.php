<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#pollanswer
 */
class PollAnswer implements \JsonSerializable
{
	protected string $pollId;
	protected ?Chat $voterChat;
	protected ?User $user;
	/**
	 * @var int[]
	 */
	protected array $optionIds;

	public function __construct(
		string $pollId = "",
		?Chat $voterChat = null,
		?User $user = null,
		array $optionIds = []
	)
	{
		$this->pollId = $pollId;
		$this->voterChat = $voterChat;
		$this->user = $user;
		$this->optionIds = $optionIds;

		foreach ($this->optionIds as $id) {
			if (!is_int($id)) {
				throw new \InvalidArgumentException("All optionIds must be integers");
			}
		}
	}

	public static function fromArray(array $array): PollAnswer
	{
		return new static(
			$array["poll_id"] ?? "",
			$array["voter_chat"] ? Chat::fromArray($array["voter_chat"]) : null,
			$array["user"] ? User::fromArray($array["user"]) : null,
			$array["option_ids"] ?? []
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"poll_id" => $this->pollId,
			"option_ids" => $this->optionIds,
		];

		if (isset($this->voterChat)) {
			$array["voter_chat"] = $this->voterChat->jsonSerialize();
		}
		if (isset($this->user)) {
			$array["user"] = $this->user->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getPollId(): string
	{
		return $this->pollId;
	}

	/**
	 * @return Chat|null
	 */
	public function getVoterChat(): ?Chat
	{
		return $this->voterChat;
	}

	/**
	 * @return User|null
	 */
	public function getUser(): ?User
	{
		return $this->user;
	}
}