<?php

namespace App\Http\Services\Barang\ListBarang;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class ListBarangOptions extends OliveMedikaEnum
{
	const ALL = 'all';
	const GENERIC = 'generic';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Invalid ListBarangOptions', 2005);
	}
}