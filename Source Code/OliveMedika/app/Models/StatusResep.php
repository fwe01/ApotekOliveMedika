<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class StatusResep extends OliveMedikaEnum
{
	const KONFIRMASI = 'menunggu_konfirmasi';
	const DITOLAK = 'ditolak';
	const DITERIMA = 'diterima';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Invalid Status Resep', 2011);
	}
}