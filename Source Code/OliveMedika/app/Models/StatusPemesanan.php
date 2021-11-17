<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class StatusPemesanan extends OliveMedikaEnum
{
	const SEDANG_DIPROSES = 'sedang_diproses';
	const DIBATALKAN = 'dibatalkan';
	const SELESAI = 'selesai';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Status Pesanan Invalid', 2019);
	}
}
