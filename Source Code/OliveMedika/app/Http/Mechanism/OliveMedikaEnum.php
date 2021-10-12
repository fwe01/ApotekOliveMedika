<?php

namespace App\Http\Mechanism;

use App\Exceptions\OliveMedikaException;
use ReflectionClass;

abstract class OliveMedikaEnum
{
	protected $value;

	/**
	 * OliveMedikaEnum constructor.
	 * @param $value
	 * @throws OliveMedikaException
	 */
	public function __construct($value)
	{
		$reflection = new ReflectionClass(static::class);
		foreach ($reflection->getConstants() as $key => $val) {
			if ($value == $val) {
				$this->value = $value;
			}
		}

		if (!isset($this->value)) {
			throw $this->onErrorException();
		}
	}

	abstract protected function onErrorException(): OliveMedikaException;

	public function getValue()
	{
		return $this->value;
	}
}