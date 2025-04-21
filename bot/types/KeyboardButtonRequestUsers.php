<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#keyboardbuttonrequestusers
 */
class KeyboardButtonRequestUsers implements \JsonSerializable
{
	protected int $requestId;
	protected bool $userIsBot;
	protected bool $userIsPremium;
	protected ?int $maxQuantity;
	protected bool $requestName;
	protected bool $requestUsername;
	protected bool $requestPhoto;

	public function __construct(
		int $requestId = 0,
		bool $userIsBot = false,
		bool $userIsPremium = false,
		?int $maxQuantity = null,
		bool $requestName = false,
		bool $requestUsername = false,
		bool $requestPhoto = false
	)
	{
		$this->requestId = $requestId;
		$this->userIsBot = $userIsBot;
		$this->userIsPremium = $userIsPremium;
		$this->maxQuantity = $maxQuantity;
		$this->requestName = $requestName;
		$this->requestUsername = $requestUsername;
		$this->requestPhoto = $requestPhoto;
	}

	public static function fromArray(array $array): KeyboardButtonRequestUsers
	{
		return new static(
			$array["request_id"] ?? 0,
			$array["user_is_bot"] ?? false,
			$array["user_is_premium"] ?? false,
			$array["max_quantity"],
			$array["request_name"] ?? false,
			$array["request_username"] ?? false,
			$array["request_photo"] ?? false,
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"request_id" => $this->requestId,
			"user_is_bot" => $this->userIsBot,
			"user_is_premium" => $this->userIsPremium,
			"request_name" => $this->requestName,
			"request_username" => $this->requestUsername,
			"request_photo" => $this->requestPhoto,
		];

		if (isset($this->maxQuantity)){
			$array["max_quantity"] = $this->maxQuantity;
		}

		return $array;
	}

	/**
	 * @return int
	 */
	public function getRequestId(): int
	{
		return $this->requestId;
	}

	/**
	 * @return bool
	 */
	public function isUserIsBot(): bool
	{
		return $this->userIsBot;
	}

	/**
	 * @return bool
	 */
	public function isUserIsPremium(): bool
	{
		return $this->userIsPremium;
	}

	/**
	 * @return int|null
	 */
	public function getMaxQuantity(): ?int
	{
		return $this->maxQuantity;
	}

	/**
	 * @return bool
	 */
	public function isRequestName(): bool
	{
		return $this->requestName;
	}

	/**
	 * @return bool
	 */
	public function isRequestUsername(): bool
	{
		return $this->requestUsername;
	}

	/**
	 * @return bool
	 */
	public function isRequestPhoto(): bool
	{
		return $this->requestPhoto;
	}
}