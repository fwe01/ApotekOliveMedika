<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\Promo\CreatePromo\CreatePromoRequest;
use App\Http\Services\Promo\CreatePromo\CreatePromoService;
use App\Http\Services\Promo\DeletePromo\DeletePromoRequest;
use App\Http\Services\Promo\DeletePromo\DeletePromoService;
use App\Http\Services\Promo\ListPromo\ListPromoService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PromoController
{
	/**
	 * @throws OliveMedikaException
	 */
	public function index()
	{
		$input = new ListBarangRequest(new ListBarangOptions(ListBarangOptions::ALL));

		/** @var ListBarangService $service */
		$service = resolve(ListBarangService::class);
		$barangs = $service->execute($input);

		$barang_options = [];
		foreach ($barangs as $barang) {
			$barang_options[$barang->getNama()] = $barang->getId();
		}

		/** @var ListPromoService $service */
		$service = resolve(ListPromoService::class);
		$promos = $service->execute();

		return view('admin.promos.index', compact('barang_options', 'promos'));
	}

	public function add(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id_barang' => 'required',
				'harga_promo_per_unit' => 'required',
				'tanggal_mulai' => 'required',
				'tanggal_berakhir' => 'required',
			]
		);

		$input = new CreatePromoRequest(
			$request->input('id_barang'),
			$request->input('harga_promo_per_unit'),
			$request->input('tanggal_mulai'),
			$request->input('tanggal_berakhir'),
		);

		/** @var CreatePromoService $service */
		$service = resolve(CreatePromoService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menambahkan promo');
		}
		return redirect()->back()->with('success', 'Promo berhasil ditambahkan');
	}

	public function delete(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required',
			]
		);

		$input = new DeletePromoRequest(
			$request->input('id'),
		);

		/** @var DeletePromoService $service */
		$service = resolve(DeletePromoService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menghapus promo');
		}
		return redirect()->back()->with('success', 'Promo berhasil dihapus');
	}
}