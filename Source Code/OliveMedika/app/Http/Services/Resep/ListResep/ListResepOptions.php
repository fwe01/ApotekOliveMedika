<?php

namespace App\Http\Services\Resep\ListResep;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class ListResepOptions extends OliveMedikaEnum
{
	const ADMIN = 'admin';
	const USER = 'user';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Invalid ListResepOptions', 2012);
	}
}