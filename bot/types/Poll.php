<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#poll
 */
class Poll implements \JsonSerializable
{
	protected string $id;
	protected string $question;
	/**
	 * @var MessageEntity[]
	 */
	protected array $questionEntities;
	/**
	 * @var PollOption[]
	 */
	protected array $options;
	protected int $totalVoterCount;
	protected bool $isClosed;
	protected bool $isAnonymous;
	protected string $type;
	protected bool $allowsMultipleAnswers;
	protected ?int $correctOptionId;
	protected ?string $explanation;
	/**
	 * @var MessageEntity[]
	 */
	protected array $explanationEntities;
	protected ?int $openPeriod;
	protected ?int $closeDate;

	public function __construct(
		string $id = "",
		string $question = "",
		array $questionEntities = [],
		array $options = [],
		int $totalVoterCount = 0,
		bool $isClosed = false,
		bool $isAnonymous = false,
		string $type = "",
		bool $allowsMultipleAnswers = false,
		?int $correctOptionId = null,
		?string $explanation = null,
		array $explanationEntities = [],
		?int $openPeriod = null,
		?int $closeDate = null
	)
	{
		$this->id = $id;
		$this->question = $question;
		$this->questionEntities = $questionEntities;
		$this->options = $options;
		$this->totalVoterCount = $totalVoterCount;
		$this->isClosed = $isClosed;
		$this->isAnonymous = $isAnonymous;
		$this->type = $type;
		$this->allowsMultipleAnswers = $allowsMultipleAnswers;
		$this->correctOptionId = $correctOptionId;
		$this->explanation = $explanation;
		$this->explanationEntities = $explanationEntities;
		$this->openPeriod = $openPeriod;
		$this->closeDate = $closeDate;

		foreach ($this->questionEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All question entities must be instances of " . MessageEntity::class);
			}
		}

		foreach ($this->options as $option) {
			if (!$option instanceof PollOption) {
				throw new \InvalidArgumentException("All options must be instances of " . PollOption::class);
			}
		}

		foreach ($this->explanationEntities as $entity) {
			if (!$entity instanceof MessageEntity) {
				throw new \InvalidArgumentException("All explanation entities must be instances of " . MessageEntity::class);
			}
		}
	}

	public static function fromArray(array $array): Poll
	{
		return new static(
			$array["id"] ?? "",
			$array["question"] ?? "",
			$array["question_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["question_entities"]) : [],
			$array["options"] ? array_map(fn($option) => PollOption::fromArray($option), $array["options"]) : [],
			$array["total_voter_count"] ?? 0,
			$array["is_closed"] ?? false,
			$array["is_anonymous"] ?? false,
			$array["type"] ?? "",
			$array["allows_multiple_answers"] ?? false,
			$array["correct_option_id"] ?? null,
			$array["explanation"] ?? null,
			$array["explanation_entities"] ? array_map(fn($entity) => MessageEntity::fromArray($entity), $array["explanation_entities"]) : [],
			$array["open_period"] ?? null,
			$array["close_date"] ?? null,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"id" => $this->id,
			"question" => $this->question,
			"question_entities" => $this->questionEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->questionEntities) : [],
			"options" => $this->options ? array_map(fn($option) => $option->jsonSerialize(), $this->options) : [],
			"total_voter_count" => $this->totalVoterCount,
			"is_closed" => $this->isClosed,
			"is_anonymous" => $this->isAnonymous,
			"type" => $this->type,
			"allows_multiple_answers" => $this->allowsMultipleAnswers,
			"explanation_entities" => $this->explanationEntities ? array_map(fn($entity) => $entity->jsonSerialize(), $this->explanationEntities) : [],
		];

		if (isset($this->correctOptionId)){
			$array["correct_option_id"] = $this->correctOptionId;
		}
		if (isset($this->explanation)){
			$array["explanation"] = $this->explanation;
		}
		if (isset($this->openPeriod)){
			$array["open_period"] = $this->openPeriod;
		}
		if (isset($this->closeDate)){
			$array["close_date"] = $this->closeDate;
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
	 * @return string
	 */
	public function getQuestion(): string
	{
		return $this->question;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getQuestionEntities(): array
	{
		return $this->questionEntities;
	}

	/**
	 * @return PollOption[]
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

	/**
	 * @return int
	 */
	public function getTotalVoterCount(): int
	{
		return $this->totalVoterCount;
	}

	/**
	 * @return bool
	 */
	public function isClosed(): bool
	{
		return $this->isClosed;
	}

	/**
	 * @return bool
	 */
	public function isAnonymous(): bool
	{
		return $this->isAnonymous;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return bool
	 */
	public function isAllowsMultipleAnswers(): bool
	{
		return $this->allowsMultipleAnswers;
	}

	/**
	 * @return int|null
	 */
	public function getCorrectOptionId(): ?int
	{
		return $this->correctOptionId;
	}

	/**
	 * @return string|null
	 */
	public function getExplanation(): ?string
	{
		return $this->explanation;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getExplanationEntities(): array
	{
		return $this->explanationEntities;
	}

	/**
	 * @return int|null
	 */
	public function getOpenPeriod(): ?int
	{
		return $this->openPeriod;
	}

	/**
	 * @return int|null
	 */
	public function getCloseDate(): ?int
	{
		return $this->closeDate;
	}
}