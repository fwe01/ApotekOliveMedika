<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\UnitOfWork;
use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\Pemesanan\CreatePemesanan\BarangPemesanan;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananRequest;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananService;
use App\Http\Services\Resep\AcceptResep\AcceptResepRequest;
use App\Http\Services\Resep\AcceptResep\AcceptResepService;
use App\Http\Services\Resep\CancelResep\CancelResepRequest;
use App\Http\Services\Resep\CancelResep\CancelResepService;
use App\Http\Services\Resep\ListResep\ListResepOptions;
use App\Http\Services\Resep\ListResep\ListResepRequest;
use App\Http\Services\Resep\ListResep\ListResepService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResepController
{
	private UnitOfWork $unit_of_work;

	/**
	 * @param UnitOfWork $unit_of_work
	 */
	public function __construct(UnitOfWork $unit_of_work)
	{
		$this->unit_of_work = $unit_of_work;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function index()
	{
		$input = new ListResepRequest(new ListResepOptions(ListResepOptions::ADMIN));

		/** @var ListResepService $service */
		$service = resolve(ListResepService::class);
		$reseps = $service->execute($input);

		$input = new ListBarangRequest(new ListBarangOptions(ListBarangOptions::ALL));
		/** @var ListBarangService $service */
		$service = resolve(ListBarangService::class);
		$barangs = $service->execute($input);

		return view('admin.reseps.index', compact('reseps', 'barangs'));
	}

	public function cancel(Request $request)
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new CancelResepRequest($request->input('id'));

		/** @var CancelResepService $service */
		$service = resolve(CancelResepService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menolak resep');
		}
		return redirect()->back()->with('success', 'Pemesanan berhasil ditolak');
	}

	public function add(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'resep_id' => 'required',
				'user_id' => 'required',
				'id' => 'required',
				'jumlah' => 'required'
			]
		);

		$id = $request->input('id');
		$jumlah = $request->input('jumlah');

		/** @var BarangPemesanan $barangs */
		$barangs = [];
		for ($barang = 0; $barang < count($id); $barang++) {
			$barangs[] = new BarangPemesanan(
				$id[$barang],
				$jumlah[$barang]
			);
		}

		$create_pemesanan_input = new CreatePemesananRequest(
			$request->input('user_id'),
			$barangs
		);

		/** @var CreatePemesananService $create_pemesanan_service */
		$create_pemesanan_service = resolve(CreatePemesananService::class);

		$terima_resep_input = new AcceptResepRequest(
			$request->input('resep_id')
		);

		/** @var AcceptResepService $terima_resep_service */
		$terima_resep_service = resolve(AcceptResepService::class);

		$this->unit_of_work->begin();
		try {
			$terima_resep_service->execute($terima_resep_input);
			$response = $create_pemesanan_service->execute($create_pemesanan_input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal membuat pemesanan - ' . $e->getMessage());
		}
		$this->unit_of_work->commit();
		return redirect()->route('admin.pemesanans.detail', ['id' => $response->getId()])
			->with('success', 'Pemesanan berhasil dibuat');
	}
}
