<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananRequest;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananService;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananRequest;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananService;
use App\Models\UserType;
use Exception;
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

	/**
	 * @throws OliveMedikaException
	 */
	public function delete(Request $request)
	{
		$request->validate(
			[
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
}