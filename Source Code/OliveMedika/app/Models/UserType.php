<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;

class UserType extends \App\Http\Mechanism\OliveMedikaEnum
{
	const ADMIN = 'admin';
	const USER = 'user';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('invalid user type', 2017);
	}
}