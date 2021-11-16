<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananRequest;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananService;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananRequest;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananService;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananRequest;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananService;
use App\Models\UserType;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PemesananController
{
	public function index()
	{
		$input = new ListPemesananRequest(
			new UserType(UserType::ADMIN),
			0
		);
		/** @var ListPemesananService $service */
		$service = resolve(ListPemesananService::class);
		$pemesanans = $service->execute($input);

		return view('admin.pemesanans.index', compact('pemesanans'));
	}

	public function delete(Request $request): RedirectResponse
	{
		$request->validate([
							   'id' => 'required'
						   ]
		);

		$input = new DeletePemesananRequest($request->input('id'), new UserType(UserType::ADMIN), 0);
		/** @var DeletePemesananService $service */
		$service = resolve(DeletePemesananService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menghapus pemesanan');
		}
		return redirect()->back()->with('success', 'Pemesanan berhasil dihapus');
	}

	public function detail(int $id)
	{
		$input = new FindPemesananRequest($id, new UserType(UserType::ADMIN), 0);
		/** @var FindPemesananService $service */
		$service = resolve(FindPemesananService::class);
		$pemesanan = $service->execute($input);

		return view('admin.pemesanans.detail', compact('pemesanan'));
	}
}