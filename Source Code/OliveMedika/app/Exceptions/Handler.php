<?php

namespace App\Exceptions;

use App\Http\Mechanism\UnitOfWork;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


	/**
	 * Create a new exception handler instance.
	 *
	 * @param Container $container
	 * @param UnitOfWork $unitOfWork
	 */
	public function __construct(Container $container, UnitOfWork $unitOfWork)
	{
		$this->container = $container;

		$this->register();

		$unitOfWork->rollbackAllTransaction();
	}

	/**
	 * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
