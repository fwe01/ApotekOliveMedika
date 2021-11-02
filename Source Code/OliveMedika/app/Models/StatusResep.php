<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class StatusResep extends OliveMedikaEnum
{
	public const KONFIRMASI = 'menunggu_konfirmasi';
	public const DITOLAK = 'ditolak';
	public const DITERIMA = 'diterima';

	protected function onErrorException(): OliveMedikaException
	{
		return new OliveMedikaException('Invalid Status Resep', 2011);
	}
}