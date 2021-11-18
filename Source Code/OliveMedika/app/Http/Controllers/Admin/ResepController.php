<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Resep\CancelResep\CancelResepRequest;
use App\Http\Services\Resep\CancelResep\CancelResepService;
use App\Http\Services\Resep\ListResep\ListResepOptions;
use App\Http\Services\Resep\ListResep\ListResepRequest;
use App\Http\Services\Resep\ListResep\ListResepService;
use Exception;
use Illuminate\Http\Request;

class ResepController
{
	/**
	 * @throws OliveMedikaException
	 */
	public function index()
	{
		$input = new ListResepRequest(new ListResepOptions(ListResepOptions::ADMIN));

		/** @var ListResepService $service */
		$service = resolve(ListResepService::class);
		$reseps = $service->execute($input);

		return view('admin.reseps.index', compact('reseps'));
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
}
