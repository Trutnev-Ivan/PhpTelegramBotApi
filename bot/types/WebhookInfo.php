<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#webhookinfo
 */
class WebhookInfo implements \JsonSerializable
{
	protected string $url;
	protected bool $hasCustomCertificate;
	protected int $pendingUpdateCount;
	protected ?string $ipAddress;
	protected ?int $lastErrorDate;
	protected ?string $lastErrorMessage;
	protected ?int $lastSynchronizationErrorDate;
	protected ?int $maxConnections;
	/**
	 * @var string[]
	 */
	protected array $allowedUpdates;

	public function __construct(
		string $url = "",
		bool $hasCustomCertificate = false,
		int $pendingUpdateCount = 0,
		?string $ipAddress = null,
		?int $lastErrorDate = null,
		?string $lastErrorMessage = null,
		?int $lastSynchronizationErrorDate = null,
		?int $maxConnections = null,
		array $allowedUpdates = []
	)
	{
		$this->url = $url;
		$this->hasCustomCertificate = $hasCustomCertificate;
		$this->pendingUpdateCount = $pendingUpdateCount;
		$this->ipAddress = $ipAddress;
		$this->lastErrorDate = $lastErrorDate;
		$this->lastErrorMessage = $lastErrorMessage;
		$this->lastSynchronizationErrorDate = $lastSynchronizationErrorDate;
		$this->maxConnections = $maxConnections;
		$this->allowedUpdates = $allowedUpdates;

		foreach ($this->allowedUpdates as $allowedUpdate) {
			if (!is_string($allowedUpdate)) {
				throw new \InvalidArgumentException("Allowed update must be a string");
			}
		}
	}

	public static function fromArray(array $array): WebhookInfo
	{
		return new static(
			$array["url"] ?? "",
			$array["has_custom_certificate"] ?? false,
			$array["pending_update_count"] ?? 0,
			$array["ip_address"],
			$array["last_error_date"],
			$array["last_error_message"],
			$array["last_synchronization_error_date"],
			$array["max_connections"],
			$array["allowed_updates"] ?? []
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"url" => $this->url,
			"has_custom_certificate" => $this->hasCustomCertificate,
			"pending_update_count" => $this->pendingUpdateCount,
			"allowed_updates" => $this->allowedUpdates,
		];

		if (isset($this->ipAddress)) {
			$array["ip_address"] = $this->ipAddress;
		}
		if (isset($this->lastErrorDate)) {
			$array["last_error_date"] = $this->lastErrorDate;
		}
		if (isset($this->lastErrorMessage)) {
			$array["last_error_message"] = $this->lastErrorMessage;
		}
		if (isset($this->lastSynchronizationErrorDate)) {
			$array["last_synchronization_error_date"] = $this->lastSynchronizationErrorDate;
		}
		if (isset($this->maxConnections)) {
			$array["max_connections"] = $this->maxConnections;
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @return bool
	 */
	public function hasCustomCertificate(): bool
	{
		return $this->hasCustomCertificate;
	}

	/**
	 * @return int
	 */
	public function getPendingUpdateCount(): int
	{
		return $this->pendingUpdateCount;
	}

	/**
	 * @return string|null
	 */
	public function getIpAddress(): ?string
	{
		return $this->ipAddress;
	}

	/**
	 * @return int|null
	 */
	public function getLastErrorDate(): ?int
	{
		return $this->lastErrorDate;
	}

	/**
	 * @return string|null
	 */
	public function getLastErrorMessage(): ?string
	{
		return $this->lastErrorMessage;
	}

	/**
	 * @return int|null
	 */
	public function getLastSynchronizationErrorDate(): ?int
	{
		return $this->lastSynchronizationErrorDate;
	}

	/**
	 * @return int|null
	 */
	public function getMaxConnections(): ?int
	{
		return $this->maxConnections;
	}

	/**
	 * @return string[]
	 */
	public function getAllowedUpdates(): array
	{
		return $this->allowedUpdates;
	}
}