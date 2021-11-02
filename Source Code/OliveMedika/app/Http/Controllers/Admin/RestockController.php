<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\Restock\CreateRestock\CreateRestockRequest;
use App\Http\Services\Restock\CreateRestock\CreateRestockService;
use App\Http\Services\Restock\ListRestock\ListRestockService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestockController
{
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

		/** @var ListRestockService $service */
		$service = resolve(ListRestockService::class);
		$restocks = $service->execute();

		return view('admin.restocks.index', compact('barang_options', 'restocks'));
	}

	/**
	 * @throws Exception
	 */
	public function add(Request $request)
	{
		$request->validate(
			[
				'id_barang' => 'required',
				'jumlah' => 'required',
				'harga_per_unit' => 'required',
			]
		);

		$input = new CreateRestockRequest(
			$request->input('id_barang'),
			Auth::guard('admin')->user()->username,
			$request->input('jumlah'),
			$request->input('harga_per_unit'),
		);

		/** @var CreateRestockService $service */
		$service = resolve(CreateRestockService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menambahkan restock');
		}
		return redirect()->back()->with('success', 'Restock berhasil ditambahkan');
	}
}