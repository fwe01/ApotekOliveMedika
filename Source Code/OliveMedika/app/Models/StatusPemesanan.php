<?php

namespace App\Models;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\OliveMedikaEnum;

class StatusPemesanan extends OliveMedikaEnum
{
    const MENUNGGU_PROSES = 'menunggu_proses';
    const SEDANG_DIPROSES = 'sedang_diproses';
    const SELESAI = 'selesai';

    protected function onErrorException(): OliveMedikaException
    {
        return new OliveMedikaException('Status Pesanan Invalid', 2019);
    }
}
