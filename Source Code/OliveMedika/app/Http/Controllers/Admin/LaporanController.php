<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Laporan\GetLaporan\GetLaporanRequest;
use App\Http\Services\Laporan\GetLaporan\GetLaporanService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
		$periode = $input->getStartDate()->format('Y/m/d') . ' - ' . $input->getEndDate()->format('Y/m/d');

		return view('admin.laporans.index', compact('laporan', 'periode'));
	}

	public function find(Request $request)
	{
		$request->validate(
			[
				'tanggal_mulai' => 'required',
				'tanggal_berakhir' => 'required',
			]
		);
		$input = new GetLaporanRequest(
			Carbon::createFromFormat('d/m/Y', $request->input('tanggal_mulai'))->startOfDay(),
			Carbon::createFromFormat('d/m/Y', $request->input('tanggal_berakhir'))->endOfDay(),
		);

		/** @var GetLaporanService $service */
		$service = resolve(GetLaporanService::class);

		$laporan = $service->execute($input);

		$periode = $input->getStartDate()->format('Y/m/d') . ' - ' . $input->getEndDate()->format('Y/m/d');

		return view('admin.laporans.index', compact('laporan', 'periode'));
	}
}
