<?php

namespace App\Http\Services\Laporan\GetLaporan;

use Carbon\Carbon;

class GetLaporanRequest
{
	private Carbon $start_date;
	private Carbon $end_date;

	/**
	 * @param Carbon $start_date
	 * @param Carbon $end_date
	 */
	public function __construct(Carbon $start_date, Carbon $end_date)
	{
		$this->start_date = $start_date;
		$this->end_date = $end_date;
	}

	/**
	 * @return Carbon
	 */
	public function getStartDate(): Carbon
	{
		return $this->start_date;
	}

	/**
	 * @return Carbon
	 */
	public function getEndDate(): Carbon
	{
		return $this->end_date;
	}
}
