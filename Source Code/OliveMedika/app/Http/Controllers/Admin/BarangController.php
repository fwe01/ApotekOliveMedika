<?php

namespace App\Http\Controllers\Admin;


use App\Exceptions\OliveMedikaException;
use App\Http\Services\Barang\CreateBarang\CreateBarangRequest;
use App\Http\Services\Barang\CreateBarang\CreateBarangService;
use App\Http\Services\Barang\DeleteBarang\DeleteBarangRequest;
use App\Http\Services\Barang\DeleteBarang\DeleteBarangService;
use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\Barang\UpdateBarang\UpdateBarangRequest;
use App\Http\Services\Barang\UpdateBarang\UpdateBarangService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BarangController
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
		return view('admin.barangs.index', compact('barangs'));
	}

	public function add(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'nama' => 'required',
				'harga' => 'required',
				'type' => 'required',
				'is_generic' => 'required',
				'gambar' => 'required',
			]
		);

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

	public function delete(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new DeleteBarangRequest($request->input('id'));

		/** @var DeleteBarangService $service */
		$service = resolve(DeleteBarangService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			if ($e instanceof OliveMedikaException && $e->getCode() === 2007) {
				return redirect()->back()->with('alert', 'Barang tidak ditemukan');
			}
			return redirect()->back()->with('alert', 'Gagal menghapus barang');
		}
		return redirect()->back()->with('success', 'barang berhasil dihapus');
	}

	public function update(Request $request)
	{
		$request->validate(
			[
				'id' => 'required',
				'nama' => 'required',
				'harga' => 'required',
				'type' => 'required',
				'is_generic' => 'required',
			]
		);

		$input = new UpdateBarangRequest(
			$request->input('id'),
			$request->input('nama'),
			$request->input('harga'),
			$request->input('is_generic'),
			$request->input('type'),
			$request->file('gambar')
		);

		/** @var UpdateBarangService $service */
		$service = resolve(UpdateBarangService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			if ($e instanceof OliveMedikaException && $e->getCode() === 2001) {
				return redirect()->back()->with('alert', 'Barang tidak ditemukan');
			}
			return redirect()->back()->with('alert', 'Gagal mengupdate barang');
		}
		return redirect()->back()->with('success', 'Barang berhasil diupdate');
	}
}