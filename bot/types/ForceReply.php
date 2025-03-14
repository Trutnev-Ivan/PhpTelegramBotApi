<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#forcereply
 */
class ForceReply implements \JsonSerializable
{
	protected bool $forceReply;
	protected ?string $inputFieldPlaceholder;
	protected bool $selective;

	public function __construct(
		bool $forceReply = true,
		?string $inputFieldPlaceholder = null,
		bool $selective = false
	)
	{
		$this->forceReply = $forceReply;
		$this->inputFieldPlaceholder = $inputFieldPlaceholder;
		$this->selective = $selective;
	}

	public static function fromArray(array $array): ForceReply
	{
		return new static(
			$array["force_reply"] ?? true,
			$array["input_field_placeholder"],
			$array["selective"] ?? false,
		);
	}

	public function jsonSerialize()
	{
		return [
			"force_reply" => $this->forceReply,
			"input_field_placeholder" => $this->inputFieldPlaceholder,
			"selective" => $this->selective,
		];
	}

	/**
	 * @return bool
	 */
	public function isForceReply(): bool
	{
		return $this->forceReply;
	}

	/**
	 * @return string|null
	 */
	public function getInputFieldPlaceholder(): ?string
	{
		return $this->inputFieldPlaceholder;
	}

	/**
	 * @return bool
	 */
	public function isSelective(): bool
	{
		return $this->selective;
	}
}