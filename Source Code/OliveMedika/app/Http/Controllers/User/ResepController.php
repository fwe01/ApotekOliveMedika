<?php

namespace App\Http\Controllers\User;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Resep\CreateResep\CreateResepRequest;
use App\Http\Services\Resep\CreateResep\CreateResepService;
use App\Models\StatusResep;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController
{
	public function add(Request $request)
	{
		$request->validate(
			[
				'gambar' => 'required|max:3072',
			]
		);

		$input = new CreateResepRequest(
			Auth::guard('user')->user()->id,
			$request->file('gambar'),
			StatusResep::KONFIRMASI,
			null
		);

		/** @var CreateResepService $service */
		$service = resolve(CreateResepService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with(
				'alert',
				'Gagal menambahkan pesanan resep' . $e instanceof OliveMedikaException ? $e->getMessage() : ''
			);
		}
		return redirect()->back()->with('success', 'Berhasil menambahkan pesanan resep');
	}
}