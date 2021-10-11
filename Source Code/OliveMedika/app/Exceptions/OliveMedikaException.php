<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class OliveMedikaException extends Exception
{
	public static function build (string $error_key, string $error_code = null): OliveMedikaException
	{
		return new self(
			config('error.msg.' . $error_key),
			$error_code ?? config('error.code.' . $error_key)
		);
	}

	public function __construct(string $message, int $code, ?Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}