<?php namespace Telegram\Bot\Utils;

/**
 * Класс для проверки и заполнения необязательных аргументов
 */
class AdditionalParameters
{
	const STRING = "string";
	const BOOL = "bool";
	const INT = "int";
	const FLOAT = "float";

	protected array $params;
	protected array $result;

	public function __construct(array $params)
	{
		$this->params = $params;
		$this->result = [];
	}

	public function withString(string $code): AdditionalParameters
	{
		if (is_string($this->params[$code]) && strlen($this->params[$code])) {
			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	public function withInt(string $code): AdditionalParameters
	{
		if (is_int($this->params[$code])) {
			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	public function withFloat(string $code): AdditionalParameters
	{
		if (is_float($this->params[$code])) {
			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	public function withBool(string $code): AdditionalParameters
	{
		if (is_bool($this->params[$code])) {
			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @param string $className
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withClass(string $code, string $className): AdditionalParameters
	{
		if ($this->params[$code]) {
			if ($this->params[$code]::class !== $className) {
				throw new \InvalidArgumentException("Invalid class for parameter '{$code}'. Expected '{$className}', got '" . get_class($this->params[$code]) . "'");
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @param string $className
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withArrayOfClass(string $code, string $className): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				if ($item::class !== $className) {
					throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected '{$className}', got '" . get_class($item) . "'");
				}
			}

			$this->result[$code] = array_map(fn($item) => $item, $this->params[$code]);
		}

		return $this;
	}

	public function withArrayOfClasses(string $code, string ...$className): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				foreach ($className as $class) {
					if ($item::class === $class) {
						$this->result[$code][] = $item;
						continue 2;
					}
				}

				throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected one of '" . implode("', '", $className) . "', got '" . get_class($item) . "'");
			}
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withArrayOfInt(string $code): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				if (!is_int($item)) {
					throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected integer, got '" . get_class($item) . "'");
				}
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withArrayOfFloat(string $code): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				if (!is_float($item)) {
					throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected float, got '" . get_class($item) . "'");
				}
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withArrayOfString(string $code): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				if (!is_string($item)) {
					throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected string, got '" . get_class($item) . "'");
				}
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withArrayOfBool(string $code): AdditionalParameters
	{
		if (is_array($this->params[$code])) {
			foreach ($this->params[$code] as $item) {
				if (!is_bool($item)) {
					throw new \InvalidArgumentException("Invalid class for item in array parameter '{$code}'. Expected bool, got '" . get_class($item) . "'");
				}
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @param string ...$classNames
	 * @return AdditionalParameters
	 * @throws \InvalidArgumentException
	 */
	public function withClasses(string $code, string ...$classNames): AdditionalParameters
	{
		if ($this->params[$code]) {

			$hasClass = false;

			foreach ($classNames as $className) {
				if ($this->params[$code]::class === $className) {
					$hasClass = true;
					break;
				}
			}

			if (!$hasClass) {
				throw new \InvalidArgumentException("Invalid class for parameter '{$code}'. Expected " . implode(", ", $classNames) . ", got '" . get_class($this->params[$code]) . "'");
			}

			$this->result[$code] = $this->params[$code];
		}

		return $this;
	}

	/**
	 * @param string $code
	 * @param string ...$types
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function withTypes(string $code, string ...$types): AdditionalParameters
	{
		$classes = [];

		if (isset($this->params[$code])) {
			foreach ($types as $type) {
				switch ($type) {
					case static::BOOL:
						$this->withBool($code);
						break;
					case static::FLOAT:
						$this->withFloat($code);
						break;
					case static::INT:
						$this->withInt($code);
						break;
					case static::STRING:
						$this->withString($code);
						break;
					default:
						$classes[] = $type;
				}
			}
		}

		if (!isset($this->result[$code])) {
			try {
				$this->withClasses($code, ...$classes);
			} catch (\InvalidArgumentException $exception) {
				throw new \InvalidArgumentException("Invalid type for parameter '{$code}'. Expected one of: " . implode(", ", $types) . ", got '" . gettype($this->params[$code]) . "'");
			}
		}

		return $this;
	}

	public function getParameters(): array
	{
		return $this->result;
	}
}