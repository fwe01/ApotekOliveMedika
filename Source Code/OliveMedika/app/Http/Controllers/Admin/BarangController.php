<?php

namespace App\Http\Controllers\Admin;


use App\Exceptions\OliveMedikaException;
use App\Http\Services\Barang\CreateBarang\CreateBarangRequest;
use App\Http\Services\Barang\CreateBarang\CreateBarangService;
use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use Exception;
use Illuminate\Http\Request;

class BarangController
{
	public function index()
	{
		$input = new ListBarangRequest(new ListBarangOptions(ListBarangOptions::ALL));
		/** @var ListBarangService $service */
		$service = resolve(ListBarangService::class);
		$barangs = $service->execute($input);
		return view('admin.barangs.index', compact('barangs'));
	}

	public function add(Request $request)
	{
		$input = new CreateBarangRequest(
			$request->input('nama'),
			$request->input('harga'),
			0,
			$request->input('is_generic'),
			$request->input('type'),
			$request->file('gambar'),
		);

		/** @var CreateBarangService $service */
		$service = resolve(CreateBarangService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with(
				'alert',
				'Gagal menambahkan barang' . $e instanceof OliveMedikaException ? $e->getMessage() : ''
			);
		}
		return redirect()->back()->with('success', 'Berhasil menambahkan barang');
	}
}