<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class TypeBarang extends OliveMedikaEnum
{
	const OBAT_OBATAN = 'obat-obatan';
	const PERALATAN = 'peralatan';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Type Barang invalid', 2002);
	}
}