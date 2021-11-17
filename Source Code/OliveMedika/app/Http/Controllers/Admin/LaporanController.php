<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Laporan\GetLaporan\GetLaporanRequest;
use App\Http\Services\Laporan\GetLaporan\GetLaporanService;
use Carbon\Carbon;

class LaporanController
{
	public function index()
	{
		$input = new GetLaporanRequest(
			Carbon::now()->startOfMonth(),
			Carbon::now()
		);

		/** @var GetLaporanService $service */
		$service = resolve(GetLaporanService::class);

		$laporan = $service->execute($input);

		return view('admin.laporans.index', compact('laporan'));
	}
}
